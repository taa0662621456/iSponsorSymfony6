<?php

namespace App\Service\Order;

use App\Interface\CustomerInterface;
use App\Interface\Order\OrderEmailManagerInterface;
use App\Interface\Order\OrderInterface;
use Symfony\Component\Messenger\Transport\Sender\SenderInterface;
use Webmozart\Assert\Assert;

final class OrderEmailManager implements OrderEmailManagerInterface
{
    public const CONTACT_REQUEST = 'contact_request';

    public const ORDER_CONFIRMATION = 'order_confirmation';

    public const ORDER_CONFIRMATION_RESENT = 'order_confirmation_resent';

    public const SHIPMENT_CONFIRMATION = 'shipment_confirmation';

    public const USER_REGISTRATION = 'user_registration';

    public const PASSWORD_RESET = 'password_reset';

    public const ADMIN_PASSWORD_RESET = 'admin_password_reset';

    public const ACCOUNT_VERIFICATION_TOKEN = 'account_verification_token';


    public function __construct(private readonly SenderInterface $emailSender)
    {
    }

    public function sendConfirmationEmail(OrderInterface $order): void
    {
        /** @var CustomerInterface $customer */
        $customer = $order->getCustomer();
        $email = $customer->getEmail();
        Assert::notNull($email);

        $this->emailSender->send(
            self::ORDER_CONFIRMATION,
            [$email],
            [
                'order' => $order,
                'channel' => $order->getChannel(),
                'localeCode' => $order->getLocaleCode(),
            ],
        );
    }
}
