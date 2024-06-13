<?php
namespace Zero1\AsyncEventCustomerLoginFailed\Api;

class LoginFailedEventData implements LoginFailedEventDataInterface
{
    public function __construct(
        protected $username,
        protected $errorMessage,
        protected $errorClass
    ){ }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return string
     */
    public function getErrorClass()
    {
        return $this->errorClass;
    }
}
