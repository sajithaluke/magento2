<?php
namespace Login\Customer\Plugin;

use Magento\Customer\Api\AccountManagementInterface;
use Psr\Log\LoggerInterface;

class LogLoginAttempts
{
     /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function aroundAuthenticate(AccountManagementInterface $subject, \Closure $proceed, $username, $password)
    {
        try {
            // Attempt to authenticate the customer
            $result = $proceed($username, $password);

            // Log successful login
            $this->logger->info("Customer login attempt with email: $username  - Result: Success");

            return $result;
        } catch (\Exception $e) {
            // Log failed login
            $this->logger->error("Customer login attempt with email: $username  - Result: Failure - Error: " . $e->getMessage());

            // Rethrow the exception
            throw $e;
        }
    }
}
