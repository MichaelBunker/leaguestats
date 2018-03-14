<?php

namespace App\Util\ValueConverter;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;

/**
 * Class FloatConverterTest.
 */
class FloatConverterTest extends TestCase
{
	/**
	 * Data provider for convert tests.
	 *
	 * @return array
	 */
	public function dataProviderConvert()
	{
		return [
			'int' => [12, 12.00],
			'true string' => ['true', false],
			'true string abbr' => ['t', false],
			'true integer' => ['1', true],
			'false string' => ['false', false],
			'false string abbr' => ['f', false],
			'false integer' => ['0', 0.0],
			'null' => [null, null],
			'boolean' => [false, false]
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
		$converter = $this->createPartialMock(FloatConverter::class, ['canConvert']);

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
		$converter = $this->createPartialMock(FloatConverter::class, ['canConvert']);

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
			'ctype digit' => ['123', true],
			'numeric' => [123.00, true],
			'int' => [12, true],
			'bool' => [false, false],
			'string' => ['asdf', false]
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
		$converter = $this->createPartialMock(FloatConverter::class, []);
		$accessor  = new Proxy($converter);

		$this->assertEquals(
			$result,
			$accessor->canConvert($data)
		);
	}
}
