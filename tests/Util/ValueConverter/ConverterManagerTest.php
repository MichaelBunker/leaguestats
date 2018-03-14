<?php

namespace App\Util\ValueConverter;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;

class ConverterManagerTest extends TestCase
{
	/**
	 * Test the constructor() function.
	 */
	public function testConstructor()
	{
		$stringConverter  = $this->createMock(StringConverter::class);
		$integerConverter = $this->createMock(IntegerConverter::class);
		$floatConverter   = $this->createMock(FloatConverter::class);
		$booleanConverter = $this->createMock(BooleanConverter::class);
		$manager          = $this->createPartialMock(ConverterManager::class, []);
		$accessor         = new Proxy($manager);

		$accessor->__call('__construct', [$stringConverter, $integerConverter, $floatConverter, $booleanConverter]);

		$this->assertSame($stringConverter, $accessor->string);
		$this->assertSame($integerConverter, $accessor->integer);
		$this->assertSame($floatConverter, $accessor->float);
		$this->assertSame($booleanConverter, $accessor->boolean);
	}

	/**
	 * Test convert() function.
	 */
	public function testConvert()
	{
		$integerConverter  = $this->createMock(IntegerConverter::class);
		$manager           = $this->createPartialMock(ConverterManager::class, ['validateType']);
		$accessor          = new Proxy($manager);
		$accessor->integer = $integerConverter;

		$type = 'integer';
		$value = '1';

		$manager
			->expects($this->once())
			->method('validateType')
			->with($type)
			->willReturn(true);

		$integerConverter
			->expects($this->once())
			->method('convert')
			->with($value)
			->willReturn(1);

		$this->assertEquals(
			1,
			$accessor->convert($type, $value)
		);
	}

	/**
	 * Test validateType() function.
	 */
	public function testValidateType()
	{
		$integerConverter  = $this->createMock(IntegerConverter::class);
		$manager           = $this->createPartialMock(ConverterManager::class, []);
		$accessor          = new Proxy($manager);
		$accessor->integer = $integerConverter;

		$type = 'integer';

		$this->assertEquals(
			true,
			$accessor->validateType($type)
		);
	}
}
