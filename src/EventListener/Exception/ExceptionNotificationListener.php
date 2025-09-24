<?php

namespace App\EventListener\Exception;

use App\Service\EmailService;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

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
        try {
            $this->emailService->sendErrorNotification($errorMessage);
        } catch (TransportExceptionInterface $e) {
        }
    }
}