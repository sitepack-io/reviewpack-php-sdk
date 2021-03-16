<?php

namespace ReviewPack\Endpoint;

use ReviewPack\Exception\ApiAuthorizationError;
use ReviewPack\Exception\ApiResponseError;
use ReviewPack\Resources\AbstractResource;
use ReviewPack\Resources\Company;

/**
 * Class AbstractEndpoint
 * @package ReviewPack\Endpoint
 */
abstract class AbstractEndpoint
{

    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    private const API_ROOT = 'https://api.reviewpack.eu';

    /**
     * @param string $type
     * @param string $path
     * @param bool $hasAuthorization
     * @param string|null $token
     * @param string|null $secret
     * @param array|null $data
     * @return mixed
     * @throws ApiAuthorizationError
     * @throws ApiResponseError
     */
    protected function executeApiCall(string $type, string $path, bool $hasAuthorization = true, ?string $token = null, ?string $secret = null, ?array $data = null)
    {
        if ($hasAuthorization === true && (empty($token) || empty($secret))) {
            throw ApiAuthorizationError::byMessage('This API endpoint needs authorization, please add a token and secret!');
        }

        $curlConnection = \curl_init();
        \curl_setopt($curlConnection, CURLOPT_URL, self::API_ROOT . $path);
        \curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
        if ($type === self::METHOD_POST && \is_array($data)) {
            curl_setopt($curlConnection, CURLOPT_POST, 1);
            curl_setopt($curlConnection, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        \curl_setopt($curlConnection, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        \curl_setopt($curlConnection, CURLOPT_USERPWD, $token . ":" . $secret);
        $result = \curl_exec($curlConnection);
        \curl_close($curlConnection);

        $data = \json_decode($result);

        if ($data->status !== 'success') {
            if (isset($data->message)) {
                throw ApiResponseError::byMessage($data->message);
            }

            throw ApiResponseError::byEmptyResult();
        }

        return $data;
    }

    /**
     * @param object $result
     * @param string $class
     * @return mixed
     */
    protected function mapDataToObject(object $result, string $class)
    {
        $object = new $class;
        foreach ($result as $property => $value) {
            if (\property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    /**
     * @param array $results
     * @param string $class
     * @return AbstractResource[]
     */
    protected function mapDataToObjectsCollection(array $results, string $class)
    {
        $collection = [];
        foreach ($results as $result) {
            $collection[] = $this->mapDataToObject($result, $class);
        }

        return $collection;
    }


}