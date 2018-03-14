<?php

namespace App\Util\ValueConverter;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;

/**
 * Class StringConverterTest.
 */
class StringConverterTest extends TestCase
{
    /**
     * Data provider for convert tests.
     *
     * @return array
     */
    public function dataProviderConvert()
    {
        return [
            'true string' => ['true', 'true'],
            'true string abbr' => ['t', 't'],
            'true integer' => ['1', '1'],
            'false string' => ['false', 'false'],
            'false string abbr' => ['f', 'f'],
            'false integer' => ['0', '0'],
            'int' => [123, '123'],
            'null' => [null, null],
            'true boolean' => [true, 'true'],
            'false boolean' => [false, 'false']
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
        $converter = $this->createPartialMock(StringConverter::class, ['canConvert']);

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
        $converter = $this->createPartialMock(StringConverter::class, ['canConvert']);

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
            'true boolean' => [true, true],
            'false boolean' => [false, true],
            'null' => [null, true],
            'falsey int' => ['0', true],
            'falsey string' => ['false', true],
            'falsey string abbr' => ['f', true],
            'truthy int' => ['1', true],
            'truthy string' => ['true', true],
            'truthy string abbr' => ['t', true],
            'non bool string' => ['asdf', true],
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
        $converter = $this->createPartialMock(StringConverter::class, []);
        $accessor  = new Proxy($converter);

        $this->assertEquals(
            $result,
            $accessor->canConvert($data)
        );
    }
}
