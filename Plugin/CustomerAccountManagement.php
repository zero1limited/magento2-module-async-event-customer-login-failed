<?php
namespace Zero1\AsyncEventCustomerLoginFailed\Plugin;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Framework\Event\ManagerInterface;

class CustomerAccountManagement
{
    public function __construct(
        protected ManagerInterface $eventManager
    ){ }

    public function aroundAuthenticate(AccountManagementInterface $subject, callable $proceed, $username, $password)
    {
        try{
            return $proceed($username, $password);
        }catch(\Throwable $e){
            $this->eventManager->dispatch('customer_login_failed', [
                'username' => $username,
                'error' => $e->getMessage(),
                'errorClass' => get_class($e),
            ]);
            throw $e;
        }
    }

}
