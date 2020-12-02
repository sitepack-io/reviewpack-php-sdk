<?php

namespace ReviewPack\Endpoint;

use ReviewPack\Resources\Review;
use ReviewPack\Resources\ReviewScore;

/**
 * Class ReviewEndpoint
 * @package ReviewPack\Endpoint
 */
class ReviewEndpoint extends AbstractEndpoint
{

    /**
     * @param string $token
     * @param string $secret
     * @param string $companyUuid
     * @return mixed
     * @throws \ReviewPack\Exception\ApiAuthorizationError
     * @throws \ReviewPack\Exception\ApiResponseError
     *
     * @doc https://reviewpack.nl/developers-api#newest-reviews
     */
    public function getNewestReviews(string $token, string $secret, string $companyUuid)
    {
        $data = $this->executeApiCall(
            AbstractEndpoint::METHOD_POST,
            '/api/reviews/newest',
            true,
            $token,
            $secret,
            ['company' => $companyUuid]
        );

        return $this->mapDataToObjectsCollection($data->reviews, Review::class);
    }

    /**
     * @param string $token
     * @param string $secret
     * @param string $companyUuid
     * @return mixed
     * @throws \ReviewPack\Exception\ApiAuthorizationError
     * @throws \ReviewPack\Exception\ApiResponseError
     */
    public function getCompanyReviewScores(string $token, string $secret, string $companyUuid)
    {
        $data = $this->executeApiCall(
            AbstractEndpoint::METHOD_POST,
            '/api/reviews/score',
            true,
            $token,
            $secret,
            ['company' => $companyUuid]
        );

        return $this->mapDataToObject($data, ReviewScore::class);
    }

}