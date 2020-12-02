<?php

namespace ReviewPack\Exception;

/**
 * Class ApiAuthorizationError
 * @package ReviewPack\Exception
 */
class ApiAuthorizationError extends \Exception
{

    /**
     * @param $message
     * @return ApiResponseError
     */
    public static function byMessage($message): ApiAuthorizationError
    {
        $exception = new ApiAuthorizationError();
        $exception->message = $message;

        return $exception;
    }

}