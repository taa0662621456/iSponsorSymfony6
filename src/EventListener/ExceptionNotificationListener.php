<?php

namespace App\EventListener;

use App\Service\EmailService;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionNotificationListener implements EventSubscriberInterface
{
    private EmailService $emailService;
    private LoggerInterface $logger;

    public function __construct(EmailService $emailService, LoggerInterface $logger)
    {
        $this->emailService = $emailService;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onException',
        ];
    }

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $errorMessage = $exception->getMessage();
        $this->logger->error('Error occurred: ' . $errorMessage);
        $this->emailService->sendErrorNotification($errorMessage);
    }
}
