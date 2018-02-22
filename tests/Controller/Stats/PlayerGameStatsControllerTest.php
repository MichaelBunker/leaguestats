<?php

namespace tests\Controller\Stats;

use App\Controller\Stats\PlayerGameStatsController;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PlayerGameStatsControllerTest.
 */
class PlayerGameStatsControllerTest extends TestCase
{
	/**
	 * Test getTeams().
	 */
	public function testGetTeams()
	{
		$response = $this->createMock(JsonResponse::class);
		$criteria = $this->createMock(Criteria::class);
		$controller = $this->createPartialMock(PlayerGameStatsController::class, ['getAction']);

		$controller
			->expects($this->once())
			->method('getAction')
			->with($criteria)
			->willReturn($response);

		$this->assertEquals(
			$response,
			$controller->getPlayerGameStats($criteria)
		);
	}

	/**
	 * Test class constant is defined.
	 */
	public function testConstantIsDefined()
	{
		$controller = new PlayerGameStatsController();

		$this->assertNotNull($controller::ENTITY);
		$this->assertContains('Entity', $controller::ENTITY);
	}
}
