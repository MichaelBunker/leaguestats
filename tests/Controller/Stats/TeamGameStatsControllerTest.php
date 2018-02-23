<?php

namespace tests\Controller\Stats;

use App\Controller\Stats\TeamGameStatsController;
use App\Util\Criteria\Converter;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class TeamGameStatsControllerTest.
 */
class TeamGameStatsControllerTest extends TestCase
{
	/**
	 * Test getTeams().
	 */
	public function testGetTeams()
	{
		$response           = $this->createMock(JsonResponse::class);
		$criteria           = $this->createMock(Criteria::class);
		$convertedCriteria  = $this->createMock(Criteria::class);
		$controller         = $this->createPartialMock(TeamGameStatsController::class, ['getAction', 'convertCriteria']);

		$controller
			->expects($this->once())
			->method('convertCriteria')
			->with($criteria)
			->willReturn($convertedCriteria);

		$controller
			->expects($this->once())
			->method('getAction')
			->with($criteria)
			->willReturn($response);

		$this->assertEquals(
			$response,
			$controller->getTeamGameStats($criteria)
		);
	}

	/**
	 * Test convertCriteria().
	 */
	public function testConvertCriteria()
	{
		$converter          = $this->createMock(Converter::class);
		$criteria           = $this->createMock(Criteria::class);
		$convertedCriteria  = $this->createMock(Criteria::class);
		$controller         = $this->createPartialMock(TeamGameStatsController::class, ['get']);
		$accessor           = new Proxy($controller);

		$controller
			->expects($this->once())
			->method('get')
			->with('App\Util\Criteria\Converter')
			->willReturn($converter);

		$converter
			->expects($this->once())
			->method('convert')
			->with($criteria, 'team', ['team'])
			->willReturn($convertedCriteria);

		$this->assertEquals(
			$convertedCriteria,
			$accessor->convertCriteria($criteria)
		);
	}

	/**
	 * Test class constant is defined.
	 */
	public function testConstantIsDefined()
	{
		$controller = new TeamGameStatsController();

		$this->assertNotNull($controller::ENTITY);
		$this->assertContains('Entity', $controller::ENTITY);
	}
}
