<?php

namespace tests\Controller\Teams;

use App\Controller\Teams\TeamsController;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class TeamsControllerTest.
 */
class TeamsControllerTest extends TestCase
{
	/**
	 * Test getTeams().
	 */
	public function testGetTeams()
	{
		$response = $this->createMock(JsonResponse::class);
		$criteria = $this->createMock(Criteria::class);
		$controller = $this->createPartialMock(TeamsController::class, ['getAction']);

		$controller
			->expects($this->once())
			->method('getAction')
			->with($criteria)
			->willReturn($response);

		$this->assertEquals(
			$response,
			$controller->getTeams($criteria)
		);
	}

	/**
	 * Test class constant is defined.
	 */
	public function testConstantIsDefined()
	{
		$controller = new TeamsController();

		$this->assertNotNull($controller::ENTITY);
		$this->assertContains('Entity', $controller::ENTITY);
	}
}
