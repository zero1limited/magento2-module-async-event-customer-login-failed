<?php
declare(strict_types=1);

namespace Zero1\AsyncEventCustomerLoginFailed\Observer;

use Magento\Customer\Model\Customer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use MageOS\CommonAsyncEvents\Service\PublishingService;

class CustomerLoginFailedObserver implements ObserverInterface
{

    public function __construct(
        private readonly PublishingService $publishingService
    ) {
    }

    /**
     * @see @event customer_save_after
     */
    public function execute(Observer $observer): void
    {
        $eventIdentifier = $this->getEventIdentifier();
        if ($eventIdentifier === null) {
            return;
        }

        $this->publishingService->publish(
            $eventIdentifier,
            $observer->getEvent()->getData()
        );
    }

    private function getEventIdentifier(): ?string
    {
        return 'customer.login_failed';
    }
}
