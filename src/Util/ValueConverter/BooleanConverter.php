<?php

namespace App\Util\ValueConverter;

/**
 * Class BooleanConverter to convert data to boolean value.
 */
class BooleanConverter implements ConverterInterface
{
	/**
	 * @param mixed $data
	 *
	 * @return boolean|null
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

		if (is_bool($data)) {
			return $data;
		}

		if (in_array($data, ['1', 't', 'true'])) {
			return true;
		}

		if (in_array($data, ['0', 'f', 'false'])) {
			return false;
		}
	} // @codeCoverageIgnore

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
			|| is_bool($data)
			|| in_array($data, ['0', 'f', 'false'])
			|| in_array($data, ['1', 't', 'true']);
	}
}
