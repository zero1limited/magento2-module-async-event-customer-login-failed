<?php
namespace Zero1\AsyncEventCustomerLoginFailed\Api;

interface LoginFailedEventDataInterface
{
    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getErrorMessage();

    /**
     * @return string
     */
    public function getErrorClass();
}
