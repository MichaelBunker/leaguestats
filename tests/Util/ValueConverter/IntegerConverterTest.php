<?php

namespace App\Util\ValueConverter;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;

/**
 * Class IntegerConverterTest.
 */
class IntegerConverterTest extends TestCase
{
    /**
     * Data provider for convert tests.
     *
     * @return array
     */
    public function dataProviderConvert()
    {
        return [
            'true integer' => ['1', 1],
            'false integer' => ['0', 0],
            'null' => [null, null],
        ];
    }

    /**
     * Test convert() function.
     *
     * @dataProvider dataProviderConvert
     *
     * @param mixed   $data
     * @param boolean $result
     */
    public function testConvert($data, $result)
    {
        $converter = $this->createPartialMock(IntegerConverter::class, ['canConvert']);

        $converter
            ->expects($this->once())
            ->method('canConvert')
            ->with($data)
            ->willReturn(true);

        $this->assertEquals(
            $result,
            $converter->convert($data)
        );
    }

    /**
     * Test convert() function when exception is thrown.
     *
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Can't convert value given
     */
    public function testConvertException()
    {
        $converter = $this->createPartialMock(IntegerConverter::class, ['canConvert']);

        $data = 'asdf';

        $converter
            ->expects($this->once())
            ->method('canConvert')
            ->with($data)
            ->willReturn(false);

        $converter->convert($data);
    }

    /**
     * Data provider for canConvert() functions.
     *
     * @return array
     */
    public function dataProviderCanConvert()
    {
        return [
            'null' => [null, true],
            'falsey int' => ['0', true],
            'falsey string' => ['false', false],
            'falsey string abbr' => ['f', false],
            'truthy int' => ['1', true],
            'truthy string' => ['true', false],
            'truthy string abbr' => ['t', false],
            'non bool string' => ['asdf', false],
            'obj' => [new \stdClass(), false],
            'array' => [[], false],
            'int truthy' => [1, true],
            'int falsey' => [0, true]
        ];
    }

    /**
     * Test canConvert() function.
     *
     * @dataProvider dataProviderCanConvert
     *
     * @param mixed   $data
     * @param boolean $result
     */
    public function testCanConvert($data, $result)
    {
        $converter = $this->createPartialMock(IntegerConverter::class, []);
        $accessor  = new Proxy($converter);

        $this->assertEquals(
            $result,
            $accessor->canConvert($data)
        );
    }
}
