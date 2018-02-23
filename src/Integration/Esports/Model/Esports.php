<?php

namespace App\Integration\Esports\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use App\Entity\EsportsMatches;
use App\Enum\CrudEnum;
use App\Integration\IntegrationInterface;
use App\Integration\NotImplementedException;
use App\Integration\ModelInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Model for Esports integration.
 */
class Esports implements ModelInterface
{
	/**
	 * API Wrapper.
	 *
	 * @var IntegrationInterface
	 */
	protected $integration;

	/**
	 * Integration Serializer.
	 *
	 * @var Serializer
	 */
	protected $serializer;

	/**
	 * Riot model constructor.
	 *
	 * @param IntegrationInterface $integration
	 * @param Serializer           $modelSerializer
	 */
	public function __construct(IntegrationInterface $integration, Serializer $modelSerializer)
	{
		$this->integration = $integration;
		$this->serializer  = $modelSerializer;
	}

	/**
	 * Read.
	 *
	 * Criteria needs to send in criteria with resource to get correct uri.
	 *
	 * @param Criteria $criteria
	 *
	 * @return ArrayCollection
	 */
	public function read(Criteria $criteria): ArrayCollection
	{
		$resource = $this->getResource($criteria);

		$response = $this->integration->get($resource);
		$data     = $this->denormalizeData($response);

		return new ArrayCollection([$data]);
	}

	/**
	 * Create.
	 *
	 * @param object $entity
	 *
	 * @throws NotImplementedException Method not implemented.
	 *
	 * @return void
	 */
	public function create(object $entity)
	{
		throw new NotImplementedException(sprintf('%s is not implemented for this model', CrudEnum::CREATE));
	}

	/**
	 * Update.
	 *
	 * @param object $entity
	 *
	 * @throws NotImplementedException Method not implemented.
	 *
	 * @return void
	 */
	public function update(object $entity)
	{
		throw new NotImplementedException(sprintf('%s is not implemented for this model', CrudEnum::UPDATE));
	}

	/**
	 * Delete.
	 *
	 * @param object $entity
	 *
	 * @throws NotImplementedException Method not implemented.
	 *
	 * @return void
	 */
	public function delete(object $entity)
	{
		throw new NotImplementedException(sprintf('%s is not implemented for this model', CrudEnum::DELETE));
	}

	/**
	 * Denormalize data.
	 *
	 * @param string $data
	 *
	 * @return object
	 */
	protected function denormalizeData($data)
	{
		$dataJson = json_decode($data->getBody()->getContents());

		return $this->serializer->denormalize($dataJson, EsportsMatches::class);
	}

	/**
	 * Really just using this for the resource. Not querying against the data for anything besides match data.
	 * for now at least.
	 *
	 * @param Criteria $criteria
	 *
	 * @return array
	 */
	protected function getResource(Criteria $criteria)
	{
		$expressionList = $criteria->getWhereExpression();

		return $expressionList->getValue()->getValue();
	}
}
