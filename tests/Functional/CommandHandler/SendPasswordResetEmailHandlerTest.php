<?php

namespace App\Tests\Functional\CommandHandler;

use App\CommandHandler\SendResetPasswordEmailCommandHandler;
use App\RepositoryInterface\Payment\ChannelRepositoryInterface;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;
use PHPUnit\Framework\Attributes\Test;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Notifier\Channel\ChannelInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class SendPasswordResetEmailHandlerTest extends WebTestCase
{
    use ProphecyTrait;
    use MailerAssertionsTrait;

    #[Test]
    public function itSendsPasswordResetTokenEmail(): void
    {
        self::bootKernel();
        $container = self::getContainer();

        /** @var TranslatorInterface $translator */
        $translator = $container->get(TranslatorInterface::class);
        $mailer = $container->get('mailer');

        $channelRepository = $this->prophesize(ChannelRepositoryInterface::class);
        $userRepository = $this->prophesize(VendorRepositoryInterface::class);
        $channel = $this->prophesize(ChannelInterface::class);
        $user = $this->prophesize(UserInterface::class);

        $user->getUsername()->willReturn('username');
        $user->getPasswordResetToken()->willReturn('token');

        $channelRepository->findOneByCode('CHANNEL_CODE')->willReturn($channel->reveal());
        $userRepository->findOneByEmail('user@example.com')->willReturn($user->reveal());

        $handler = new SendResetPasswordEmailCommandHandler(
            $mailer,
            $channelRepository->reveal(),
            $userRepository->reveal(),
            $translator
        );

        $handler(new SendResetPasswordEmailCommandHandler(
            'user@example.com',
            'CHANNEL_CODE',
            'en_US'
        ));

        self::assertEmailCount(1);

        $email = self::getMailerMessage();
        self::assertEmailAddressContains($email, 'To', 'user@example.com');
        self::assertEmailHtmlBodyContains(
            $email,
            $translator->trans('email.password_reset.to_reset_your_password', [], null, 'en_US'),
        );
    }
}
