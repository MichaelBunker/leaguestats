<?php

namespace App\Integration\Esports\Model;

use App\Entity\EsportsMatches;
use App\Integration\IntegrationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\Value;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use SebastianBergmann\PeekAndPoke\Proxy;
use Symfony\Component\Serializer\Serializer;

class EsportsTest extends TestCase
{
	/**
	 * Test the constructor() function.
	 */
	public function testConstructor()
	{
		$serializer = $this->createMock(Serializer::class);
		$wrapper    = $this->createMock(IntegrationInterface::class);
		$model      = $this->createPartialMock(Esports::class, []);
		$accessor   = new Proxy($model);

		$accessor->__call('__construct', [$wrapper, $serializer]);

		$this->assertSame($serializer, $accessor->serializer);
		$this->assertSame($wrapper, $accessor->integration);
	}

	/**
	 * test read() function.
	 */
	public function testRead()
	{
		$response   = $this->createMock(ResponseInterface::class);
		$criteria   = $this->createMock(Criteria::class);
		$wrapper    = $this->createMock(IntegrationInterface::class);
		$model      = $this->createPartialMock(Esports::class, ['getResource', 'denormalizeData']);
		$accessor   = new Proxy($model);
		$accessor->integration = $wrapper;

		$resource = 'fake/resource';
		$data     = new \stdClass();

		$model
			->expects($this->once())
			->method('getResource')
			->with($criteria)
			->willReturn($resource);

		$wrapper
			->expects($this->once())
			->method('get')
			->with($resource)
			->willReturn($response);

		$model
			->expects($this->once())
			->method('denormalizeData')
			->with($response)
			->willReturn($data);

		$this->assertInstanceOf(ArrayCollection::class, $accessor->read($criteria));
	}

	/**
	 * test create() function.
	 *
	 * @expectedException \App\Integration\NotImplementedException
	 * @expectedExceptionMessage create is not implemented for this model
	 */
	public function testCreate()
	{
		$entity = new \stdClass();
		$model  = $this->createPartialMock(Esports::class, []);

		$model->create($entity);
	}

	/**
	 * test create() function.
	 *
	 * @expectedException \App\Integration\NotImplementedException
	 * @expectedExceptionMessage update is not implemented for this model
	 */
	public function testUpdate()
	{
		$entity = new \stdClass();
		$model  = $this->createPartialMock(Esports::class, []);

		$model->update($entity);
	}

	/**
	 * test create() function.
	 *
	 * @expectedException \App\Integration\NotImplementedException
	 * @expectedExceptionMessage delete is not implemented for this model
	 */
	public function testDelete()
	{
		$entity = new \stdClass();
		$model  = $this->createPartialMock(Esports::class, []);

		$model->delete($entity);
	}

	/**
	 * Test denormalizeData() function.
	 */
	public function testDenormalizeData()
	{
		$stream     = $this->createMock(StreamInterface::class);
		$response   = $this->createMock(ResponseInterface::class);
		$serializer = $this->createMock(Serializer::class);
		$model      = $this->createPartialMock(Esports::class, []);
		$accessor   = new Proxy($model);
		$accessor->serializer = $serializer;

		$data = '{"foo":"bar"}';
		$denormalizedData = [];

		$response
			->expects($this->once())
			->method('getBody')
			->with()
			->willReturn($stream);

		$stream
			->expects($this->once())
			->method('getContents')
			->with()
			->willReturn($data);

		$serializer
			->expects($this->once())
			->method('denormalize')
			->with(json_decode($data), EsportsMatches::class)
			->willReturn($denormalizedData);

		$this->assertEquals(
			$denormalizedData,
			$accessor->denormalizeData($response)
		);
	}

	/**
	 * test getResource() function.
	 */
	public function testGetResource()
	{
		$expression = $this->createMock(Comparison::class);
		$value      = $this->createMock(Value::class);
		$criteria   = $this->createMock(Criteria::class);
		$model      = $this->createPartialMock(Esports::class, []);
		$accessor   = new Proxy($model);

		$resource = 'foo';

		$criteria
			->expects($this->once())
			->method('getWhereExpression')
			->with()
			->willReturn($expression);

		$expression
			->method('getValue')
			->with()
			->willReturn($value);

		$value
			->expects($this->once())
			->method('getValue')
			->with()
			->willReturn($resource);

		$this->assertEquals(
			$resource,
			$accessor->getResource($criteria)
		);
	}
}
