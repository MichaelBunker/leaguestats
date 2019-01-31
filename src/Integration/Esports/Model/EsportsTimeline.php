<?php

namespace App\Integration\Esports\Model;

use App\Entity\EsportsMatches;
use Psr\Http\Message\ResponseInterface;

/**
 * Model for Esports integration.
 */
class EsportsTimeline extends Esports
{
    /**
     * Denormalize data.
     *
     * @param ResponseInterface $data
     *
     * @return object
     */
    protected function denormalizeData(ResponseInterface $data)
    {
        $dataJson = json_decode($data->getBody()->getContents());

        return $dataJson;
    }
}
