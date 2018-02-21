<?php

namespace App\Util\ValueConverter;

/**
 * Class ConverterManager to manage all type converters.
 */
class ConverterManager
{
    /**
     * @var StringConverter
     */
    protected $string;

    /**
     * @var IntegerConverter
     */
    protected $integer;

    /**
     * @var FloatConverter
     */
    protected $float;

    /**
     * @var BooleanConverter
     */
    protected $boolean;

    function __construct(
        StringConverter $stringConverter,
        IntegerConverter $integerConverter,
        FloatConverter $floatConverter,
        BooleanConverter $booleanConverter
    ) {
        $this->string = $stringConverter;
        $this->integer = $integerConverter;
        $this->float = $floatConverter;
        $this->boolean = $booleanConverter;
    }

    /**
     * Convert given value.
     *
     * @param mixed $type
     * @param mixed $value
     *
     * @return mixed
     */
    public function convert($type, $value)
    {
        $converter = strtolower($type);
        $this->validateType($converter);

        return $this->$converter->convert($value);
    }

    /**
     * Validate type.
     *
     * @param mixed $type
     *
     * @return boolean
     */
    protected function validateType($type)
    {
        $converters = get_object_vars($this);

        return in_array($type, $converters);
    }
}
