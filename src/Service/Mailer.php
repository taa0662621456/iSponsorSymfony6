<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Vendor\Vendors;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Twig\Error\Error;
use Twig_Environment;

class Mailer
{
    /**
     * @var Router
     */
    private $mailer;
    private $router;
    private $twig;
    public const FROM_ADDRESS = 'taa0662621456@gmail.com';

    /**
     * Mailer constructor.
     *
     * @param Swift_Mailer $mailer
     * @param RouterInterface $router
     * @param Twig_Environment $twig
     */
    public function __construct(Swift_Mailer $mailer, RouterInterface $router, Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @param Vendors $vendor
     * @throws Error
     */
    public function sendConfirmationMessage(Vendors $vendor): void
    {
        $messageBody = $this->twig->render('security/confirmation.html.twig', [
            'vendor' => $vendor
        ]);

        $message = new Swift_Message();
        $message
            ->setSubject('You\'r registration is done!')
            ->setFrom(self::FROM_ADDRESS)
            ->setTo($vendor->getEmail())
            ->setBody($messageBody, 'text/html');

        $this->mailer->send($message);
    }

    /**
     * @param $parametersArray array
     * @throws Error
     */
    public function handleNotification($parametersArray): void
    {
        $event = $parametersArray['event'];
        switch ($event) {
            case 'new_order':
                $this->sendNewOrderNotification($parametersArray);
                break;
        }
    }

    /**
     * @param $parametersArray array
     * @throws Error
     */
    public function sendNewOrderNotification($parametersArray): void
    {
        $orderId = $parametersArray['order_id'];
        $to = $parametersArray['app.notifications.email_sender'];
        $subject = 'new order notification';

        //url generation
        $url = $this->router->generate(
            'order_show',
            ['id' => $orderId],
            true
        );

        $message = new Swift_Message();
        $message
            ->setSubject($subject)
            ->setFrom(self::FROM_ADDRESS)
            ->setTo($to)
            ->setBody(
                $this->twig->render(
                    'orders/orderNotificationEmail.txt.twig', [
                        'subject' => $subject,
                        'url' => $url
                    ]
                ));

        $this->mailer->send($message);
    }
}
