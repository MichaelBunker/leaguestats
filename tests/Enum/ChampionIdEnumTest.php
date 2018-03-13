<?php

namespace tests\Enum;

use App\Enum\ChampionIdEnum;
use PHPUnit\Framework\TestCase;

/**
 * Class ChampionIdEnumTest.
 */
class ChampionIdEnumTest extends TestCase
{
	/**
	 * Test getChampionName() function.
	 */
	public function testGetChampionName()
	{
		$name = ChampionIdEnum::getChampionName(ChampionIdEnum::AZIR);

		$this->assertEquals('AZIR', $name);
	}
}
