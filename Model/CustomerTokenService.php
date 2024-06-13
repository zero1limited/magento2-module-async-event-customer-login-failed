<?php
namespace Zero1\AsyncEventCustomerLoginFailed\Model;

use Magento\Integration\Model\CustomerTokenService as CoreCustomerTokenService;
use Magento\Framework\Event\ManagerInterface;
use Magento\Integration\Api\CustomerTokenServiceInterface;

class CustomerTokenService implements CustomerTokenServiceInterface
{
    public function __construct(
        protected ManagerInterface $eventManager,
        protected CoreCustomerTokenService $coreCustomerTokenService
    ){ }

    /**
     * @inheritdoc
     */
    public function createCustomerAccessToken($username, $password)
    {
        try{
            return $this->coreCustomerTokenService->createCustomerAccessToken($username, $password);
        }catch(\Throwable $e){
            $this->eventManager->dispatch('customer_login_failed', [
                'username' => $username,
                'error' => $e->getMessage(),
                'errorClass' => get_class($e),
            ]);
            throw $e;
        }
    }

    /**
     * @inheritdoc
     */
    public function revokeCustomerAccessToken($customerId)
    {
        return $this->coreCustomerTokenService->revokeCustomerAccessToken($customerId);
    }
}
