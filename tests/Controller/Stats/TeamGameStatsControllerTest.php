<?php

namespace tests\Controller\Stats;

use App\Controller\Stats\TeamGameStatsController;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;
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
		$response = $this->createMock(JsonResponse::class);
		$criteria = $this->createMock(Criteria::class);
		$controller = $this->createPartialMock(TeamGameStatsController::class, ['getAction']);

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
	 * Test class constant is defined.
	 */
	public function testConstantIsDefined()
	{
		$controller = new TeamGameStatsController();

		$this->assertNotNull($controller::ENTITY);
		$this->assertContains('Entity', $controller::ENTITY);
	}
}
