<?php

namespace tests\Controller\Matches;

use App\Controller\Matches\MatchesController;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class MatchesControllerTest.
 */
class MatchesControllerTest extends TestCase
{
	/**
	 * Test getTeams().
	 */
	public function testGetTeams()
	{
		$response = $this->createMock(JsonResponse::class);
		$criteria = $this->createMock(Criteria::class);
		$controller = $this->createPartialMock(MatchesController::class, ['getAction']);

		$controller
			->expects($this->once())
			->method('getAction')
			->with($criteria)
			->willReturn($response);

		$this->assertEquals(
			$response,
			$controller->getMatches($criteria)
		);
	}

	/**
	 * Test class constant is defined.
	 */
	public function testConstantIsDefined()
	{
		$controller = new MatchesController();

		$this->assertNotNull($controller::ENTITY);
		$this->assertContains('Entity', $controller::ENTITY);
	}
}
