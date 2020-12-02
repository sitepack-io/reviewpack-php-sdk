<?php

namespace ReviewPack\Exception;

/**
 * Class ApiResponseError
 * @package ReviewPack\Exception
 */
class ApiResponseError extends \Exception
{

    /**
     * @param $message
     * @return ApiResponseError
     */
    public static function byMessage($message): ApiResponseError
    {
        $exception = new ApiResponseError();
        $exception->message = $message;

        return $exception;
    }

    /**
     * @return ApiResponseError
     */
    public static function byEmptyResult(): ApiResponseError
    {
        $exception = new ApiResponseError();
        $exception->message = 'Bad request';

        return $exception;
    }

}