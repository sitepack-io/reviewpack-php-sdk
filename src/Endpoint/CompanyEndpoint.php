<?php

namespace ReviewPack\Endpoint;

use ReviewPack\Resources\Company;

/**
 * Class CompanyEndpoint
 * @package ReviewPack\Endpoint
 */
class CompanyEndpoint extends AbstractEndpoint
{

    /**
     * @param string $token
     * @param string $secret
     * @return mixed
     * @throws \ReviewPack\Exception\ApiAuthorizationError
     * @throws \ReviewPack\Exception\ApiResponseError
     */
    public function getCompanies(string $token, string $secret)
    {
        $data = $this->executeApiCall(AbstractEndpoint::METHOD_GET, '/api/companies', true, $token, $secret);

        return $this->mapDataToObjectsCollection($data->companies, Company::class);
    }

}