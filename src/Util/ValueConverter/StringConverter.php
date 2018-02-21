<?php

namespace App\Util\ValueConverter;

/**
 * Class to convert data into string format.
 */
class StringConverter implements ConverterInterface
{
	/**
	 * @param mixed $data
	 *
	 * @return string|null
	 *
	 * @throws \UnexpectedValueException If value cannot be converted.
	 */
	public function convert($data)
	{
		if (!$this->canConvert($data)) {
			throw new \UnexpectedValueException('Can\'t convert value given');
		}

		if (is_null($data)) {
			return null;
		}

		if (is_string($data)) {
			return $data;
		}

		if (is_bool($data)) {
			return $data ? 'true' : 'false';
		}

		return strval($data);
	}

	/**
	 * Check if data can be converted.
	 *
	 * @param mixed $data
	 *
	 * @return boolean
	 */
	protected function canConvert($data)
	{
		return is_null($data)
			|| is_string($data)
			|| is_bool($data)
			|| is_float($data)
			|| is_int($data)
			|| is_object($data) && in_array('__toString', get_class_methods($data));
	}
}
