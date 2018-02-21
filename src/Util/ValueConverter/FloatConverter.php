<?php

namespace App\Util\ValueConverter;

/**
 * Class FloatConverter to convert value to an integer.
 */
class FloatConverter implements ConverterInterface
{
    /**
     * Convert value to integer.
     *
     * @param mixed $data
     *
     * @return float|null
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

        return floatval($data);
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
            || ctype_digit($data)
            || is_numeric($data)
            || is_int($data);
    }
}
