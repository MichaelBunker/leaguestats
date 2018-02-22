<?php

namespace tests\Controller;

use App\Controller\AbstractController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AbstractControllerTest extends TestCase
{
    /**
     * Test getAction().
     */
    public function testGetAction()
    {
        $response   = $this->createMock(JsonResponse::class);
        $collection = $this->createMock(Collection::class);
        $criteria   = $this->createMock(Criteria::class);
        $controller = $this->createPartialMock(AbstractController::class, ['fetchRecords', 'createResponse']);

        $controller
            ->expects($this->once())
            ->method('fetchRecords')
            ->with($criteria)
            ->willReturn($collection);

        $controller
            ->expects($this->once())
            ->method('createResponse')
            ->with($collection, Response::HTTP_OK, ['Access-Control-Allow-Origin' => '*'])
            ->willReturn($response);

        $this->assertEquals(
            $response,
            $controller->getAction($criteria)
        );
    }

    /**
     * Test putAction()
     *
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     * @expectedExceptionMessage PUT method is not implemented
     */
    public function testPutAction()
    {
        $record     = [];
        $criteria   = $this->createMock(Criteria::class);
        $controller = $this->createPartialMock(AbstractController::class, []);
        $controller->putAction($criteria, $record);
    }

    /**
     * Test postAction()
     *
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     * @expectedExceptionMessage POST method is not implemented
     */
    public function testPostAction()
    {
        $record     = [];
        $criteria   = $this->createMock(Criteria::class);
        $controller = $this->createPartialMock(AbstractController::class, []);
        $controller->postAction($criteria, $record);
    }

    /**
     * Test deleteAction()
     *
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     * @expectedExceptionMessage DELETE method is not implemented
     */
    public function testDeleteAction()
    {
        $record     = [];
        $criteria   = $this->createMock(Criteria::class);
        $controller = $this->createPartialMock(AbstractController::class, []);
        $controller->deleteAction($criteria, $record);
    }

    /**
     * Test fetchRecords().
     */
    public function testFetchRecords()
    {
        $criteria   = $this->createMock(Criteria::class);
        $manager    = $this->createMock(ManagerRegistry::class);
        $repo       = $this->createMock(EntityRepository::class);
        $collection = $this->createMock(Collection::class);
        $controller = $this->createPartialMock(AbstractController::class, ['getDoctrine']);
        $accessor   = new Proxy($controller);

        $controller
            ->expects($this->once())
            ->method('getDoctrine')
            ->with()
            ->willReturn($manager);

        $manager
            ->expects($this->once())
            ->method('getRepository')
            ->with($controller::ENTITY)
            ->willReturn($repo);

        $repo
            ->expects($this->once())
            ->method('matching')
            ->with($criteria)
            ->willReturn($collection);

        $this->assertEquals(
            $collection,
            $accessor->fetchRecords($criteria)
        );
    }

    /**
     * Test createResponse().
     */
    public function testCreateResponse()
    {
        $status     = 201;
        $headers    = ['header' => 'CELTICS'];
        $context    = ['groups' => ['Champs']];
        $dataArray  = ['Larry Bird'];

        $response   = $this->createMock(JsonResponse::class);
        $collection = $this->createMock(Collection::class);
        $controller = $this->createPartialMock(AbstractController::class, ['json', 'getResponseData']);
        $accessor   = new Proxy($controller);

        $controller
            ->expects($this->once())
            ->method('getResponseData')
            ->with($collection)
            ->willReturn($dataArray);

        $controller
            ->expects($this->once())
            ->method('json')
            ->with($dataArray, $status, $headers, $context)
            ->willReturn($response);

        $this->assertEquals(
            $response,
            $accessor->createResponse($collection, $status, $headers, $context)
        );
    }

    /**
     * Test getResponseData().
     */
    public function testGetResponseData()
    {
        $collection = new ArrayCollection(['foo', 'bar']);
        $accessor = new Proxy($this->createPartialMock(AbstractController::class, []));
        $result = [
            'count'   => 2,
            'results' => $collection,
            'success' => true
        ];
        $this->assertEquals(
            $result,
            $accessor->getResponseData($collection)
        );
    }
}
