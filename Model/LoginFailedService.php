<?php
namespace Zero1\AsyncEventCustomerLoginFailed\Model;

use Zero1\AsyncEventCustomerLoginFailed\Api\LoginFailedEventData;

class LoginFailedService
{
    /**
     * @param string $username
     * @param string $error
     * @param string $errorClass
     * @return \Zero1\AsyncEventCustomerLoginFailed\Api\LoginFailedEventDataInterface
     */
    public function transform($username, $error, $errorClass)
    {
        return new LoginFailedEventData(
            $username,
            $error,
            $errorClass
        );
    }
}
