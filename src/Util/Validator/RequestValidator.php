<?php

namespace App\Util\Validator;

use App\Util\ValueConverter\ConverterManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Request Validator.
 */
class RequestValidator
{
	/**
	 * @var ValidatorInterface
	 */
	protected $validator;

	/**
	 * @var EntityManagerInterface
	 */
	protected $entityManager;

	/**
	 * @var ConverterManager
	 */
	protected $converterManager;

	/**
	 * RequestValidator constructor.
	 *
	 * @param ValidatorInterface     $validator
	 * @param EntityManagerInterface $entityManager
	 * @param ConverterManager       $converterManager
	 */
	public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManager, ConverterManager $converterManager)
	{
		$this->validator        = $validator;
		$this->entityManager    = $entityManager;
		$this->converterManager = $converterManager;
	}

	/**
	 * Validate request.
	 *
	 * @param string  $validator
	 * @param string  $entity
	 * @param Request $request
	 *
	 * @return void
	 */
	public function validate($validator, $entity, Request $request)
	{
		if (strpos($validator, 'Redirect') || strpos($validator, 'Profiler')) {
			return;
		}

		$metadata = $this->entityManager->getClassMetadata($entity);
		$this->validateFields($metadata, $request);
		$this->validateRequestParameters($metadata, $validator, $request);
	}

	/**
	 * Validate request fields.
	 *
	 * @param ClassMetadata $classMetadata
	 * @param Request       $request
	 *
	 * @return void
	 *
	 * @throws BadRequestHttpException Field is not valid.
	 */
	protected function validateFields(ClassMetadata $classMetadata, Request $request)
	{
		$entityFields  = $classMetadata->getFieldNames();
		$requestFields = array_keys($request->query->all());

		foreach ($requestFields as $field) {
			if (!in_array($field, $entityFields)) {
				throw new BadRequestHttpException(sprintf('%s is not a valid field', $field));
			}
		}
	}

	/**
	 * Validate request parameters.
	 *
	 * @param ClassMetadata $classMetadata
	 * @param string        $validator
	 * @param Request       $request
	 *
	 * @return void
	 *
	 * @throws BadRequestHttpException Validation errors.
	 */
	protected function validateRequestParameters(ClassMetadata $classMetadata, $validator, Request $request)
	{
		$validatorClass = new $validator;

		$this->setRequestValues($classMetadata, $validatorClass, $request->query);
		$errors = $this->validator->validate($validatorClass, null, [$request->getMethod(), Constraint::DEFAULT_GROUP]);

		if (count($errors) > 0) {
			$errorStrings = $this->buildErrorString($errors);
			throw new BadRequestHttpException(implode('. ', $errorStrings));
		}
	}

	/**
	 * Set request values to validator fields.
	 *
	 * @param ClassMetadata $classMetadata
	 * @param string        $validatorClass
	 * @param ParameterBag  $arguments
	 *
	 * @return void
	 */
	protected function setRequestValues(ClassMetadata $classMetadata, $validatorClass, ParameterBag $arguments)
	{
		$values = $arguments->all();
		$fields = $classMetadata->getFieldNames();

		foreach ($fields as $field) {
			if (isset($values[$field])) {
				$value = $values[$field];
				$type  = $classMetadata->getFieldMapping($field)['type'];

				if ($this->isComplexComparison($value)) {
					$value = $this->getComparisonValue($value);
				}

				$this->setValidatorValues($validatorClass, $type, $value, $field);
			}
		}
	}

	/**
	 * Get comparison value.
	 *
	 * @param string $comparison
	 *
	 * @return string
	 */
	protected function getComparisonValue($comparison)
	{
		$opValue = substr($comparison, 1, -1);

		return substr($opValue, 2);
	}

	/**
	 * Check if query is using complex.
	 *
	 * @param string $query
	 *
	 * @return boolean
	 */
	protected function isComplexComparison($query)
	{
		return preg_match('/\(\S*\)/', $query);
	}

	/**
	 * Build error string for validations.
	 *
	 * @param ConstraintViolationListInterface $errors
	 *
	 * @return array
	 */
	protected function buildErrorString(ConstraintViolationListInterface $errors): array
	{
		$errorStrings = [];

		foreach ($errors as $error) {
			$errorStrings[] = sprintf(
				'Validation failed for %s: %s',
				$error->getPropertyPath(),
				$error->getMessage()
			);
		}

		return $errorStrings;
	}

	/**
	 * Set validator values.
	 *
	 * @param object $validatorClass
	 * @param string $objType
	 * @param string $value
	 * @param string $field
	 *
	 * @return void
	 */
	protected function setValidatorValues(object $validatorClass, $objType, $value, $field)
	{
		$validatorClass->$field = $this->converterManager->convert($objType, $value);
	}
}
