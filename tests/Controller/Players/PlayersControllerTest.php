<?php

namespace tests\Controller\Players;

use App\Controller\Players\PlayersController;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PlayersControllerTest.
 */
class PlayersControllerTest extends TestCase
{
	/**
	 * Test getTeams().
	 */
	public function testGetTeams()
	{
		$response = $this->createMock(JsonResponse::class);
		$criteria = $this->createMock(Criteria::class);
		$controller = $this->createPartialMock(PlayersController::class, ['getAction']);

		$controller
			->expects($this->once())
			->method('getAction')
			->with($criteria)
			->willReturn($response);

		$this->assertEquals(
			$response,
			$controller->getPlayers($criteria)
		);
	}

	/**
	 * Test class constant is defined.
	 */
	public function testConstantIsDefined()
	{
		$controller = new PlayersController();

		$this->assertNotNull($controller::ENTITY);
		$this->assertContains('Entity', $controller::ENTITY);
	}
}
