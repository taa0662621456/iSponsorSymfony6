<?php

use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Twig\Environment;

class NotificationService
{
    public function __construct(
        private readonly MessageBusInterface $bus,
        private readonly Environment $twig
    ) {}

    public function sendTemplatedEmail(string $to, string $subject, string $template, array $context = [], ?string $from = 'noreply@yourdomain.com'): void
    {
        $html = $this->twig->render($template, $context);

        $this->bus->dispatch(new SendEmailMessage($to, $subject, $html, $from));
    }
}
