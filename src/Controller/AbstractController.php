<?php

namespace App\Controller;

use App\Enum\HttpEnum;
use App\Util\Visitor\RequestVisitor;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractController
 *
 * TODO Add support for PUT/POST/DELETE methods.
 * TODO make an integration controller that overrides fetchRecords.
 */
abstract class AbstractController extends Controller
{
    /**
     * Entity class for records, overridden in concrete controllers.
     */
    const ENTITY = '';

    /**
     * Get action.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction(Request $request): JsonResponse
    {
        $criteria = $this->createCriteria($request);
        $records  = $this->fetchRecords($criteria);

        return $this->createResponse($records, Response::HTTP_OK, ['Access-Control-Allow-Origin' => '*']);
    }

    /**
     * Put action.
     *
     * @param Criteria $criteria
     * @param mixed    $record
     *
     * @throws HttpException Put method isn't implemented.
     *
     * @return void
     */
    public function putAction(Criteria $criteria, $record)
    {
        throw new HttpException(Response::HTTP_NOT_IMPLEMENTED, sprintf('%s method is not implemented', HttpEnum::PUT));
    }

    /**
     * Post action.
     *
     * @param mixed $record
     *
     * @throws HttpException Post method isn't implemented.
     *
     * @return void
     */
    public function postAction($record)
    {
        throw new HttpException(Response::HTTP_NOT_IMPLEMENTED, sprintf('%s method is not implemented', HttpEnum::POST));
    }

    /**
     * Delete action.
     *
     * @param mixed $record
     *
     * @throws HttpException Delete method isn't implemented.
     *
     * @return void
     */
    public function deleteAction($record)
    {
        throw new HttpException(Response::HTTP_NOT_IMPLEMENTED, sprintf('%s method is not implemented', HttpEnum::DELETE));
    }

    /**
     * Fetch records.
     *
     * @param Criteria $criteria
     *
     * @return array
     */
    protected function fetchRecords(Criteria $criteria)
    {
        return $this->getDoctrine()->getRepository($this::ENTITY)->matching($criteria);
    }

    /**
     * Create Criteria object for request.
     *
     * @param Request $request
     *
     * @return Criteria
     */
    protected function createCriteria(Request $request): Criteria
    {
        /** @var \App\Util\Visitor\RequestVisitor $requestVisitor */
        $requestVisitor = $this->get('App\Util\Visitor\RequestVisitor');

        return $requestVisitor->create($request);
    }

    /**
     * Create json response.
     *
     * @param mixed $data
     * @param int   $status
     * @param array $headers
     * @param array $context
     *
     * @return JsonResponse
     */
    protected function createResponse($data, $status = 200, array $headers = array(), array $context = array()): JsonResponse
    {
        return $this->json($this->getResponseData($data), $status, $headers, array('groups' => array('public'))); //'public' is group without PK's returned
    }

    /**
     * Get response data.
     *
     * @param $data
     *
     * @return array
     */
    protected function getResponseData($data): array
    {
        return [
            'count' => count($data),
            'results' => $data,
            'success' => true
        ];
    }
}
