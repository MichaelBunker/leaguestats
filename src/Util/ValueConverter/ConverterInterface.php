<?php

namespace App\Util\ValueConverter;

/**
 * Interface for converter services.
 */
interface ConverterInterface
{
    /**
     * Normalize data.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function convert($data);
}
