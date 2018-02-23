<?php

namespace tests\Controller\Matches;

use App\Controller\Matches\MatchesController;
use App\Util\Criteria\Converter;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class MatchesControllerTest.
 */
class MatchesControllerTest extends TestCase
{
	/**
	 * Test getTeams().
	 */
	public function testGetMatches()
	{
		$response           = $this->createMock(JsonResponse::class);
		$criteria           = $this->createMock(Criteria::class);
		$convertedCriteria  = $this->createMock(Criteria::class);
		$controller         = $this->createPartialMock(MatchesController::class, ['getAction', 'convertCriteria']);

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
			$controller->getMatches($criteria)
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
		$controller         = $this->createPartialMock(MatchesController::class, ['get']);
		$accessor           = new Proxy($controller);

		$controller
			->expects($this->once())
			->method('get')
			->with('App\Util\Criteria\Converter')
			->willReturn($converter);

		$converter
			->expects($this->once())
			->method('convert')
			->with($criteria, 'team', ['winner', 'loser'])
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
		$controller = new MatchesController();

		$this->assertNotNull($controller::ENTITY);
		$this->assertContains('Entity', $controller::ENTITY);
	}
}
