<?php

namespace App\Tests\Functional\CommandHandler;

use App\Message\SendAccountRegistrationEmailMessage;
use App\MessageHandler\SendAccountRegistrationEmailMessageHandler;
use App\RepositoryInterface\Payment\ChannelRepositoryInterface;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;
use App\EntityInterface\Vendor\VendorChannelInterface;

use Prophecy\Prophecy\ObjectProphecy;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class SendAccountRegistrationEmailHandlerTest extends KernelTestCase
{
    public function testItSendsAccountRegistrationEmailWithHostname(): void
    {
        $container = self::getContainer();

        /** @var TranslatorInterface $translator */
        $translator = $container->get('translator');

        $emailSender = $container->get('email_sender');

        /** @var ChannelRepositoryInterface|ObjectProphecy $channelRepository */
        $channelRepository = $this->prophesize(ChannelRepositoryInterface::class);
        /** @var VendorRepositoryInterface|ObjectProphecy $userRepository */
        $userRepository = $this->prophesize(VendorRepositoryInterface::class);
        /** @var VendorChannelInterface|ObjectProphecy $channel */
        $channel = $this->prophesize(VendorChannelInterface::class);
        /** @var UserInterface|ObjectProphecy $user */
        $user = $this->prophesize(UserInterface::class);

        $user->getUsername()->willReturn('username');
        $user->getEmailVerificationToken()->willReturn('token');

        $channelRepository->findOneByCode('CHANNEL_CODE')->willReturn($channel->reveal());
        $userRepository->findOneByEmail('user@example.com')->willReturn($user->reveal());

        $sendAccountRegistrationEmailMessageHandler = new SendAccountRegistrationEmailMessageHandler(
            $userRepository->reveal(),
            $channelRepository->reveal(),
            $emailSender
        );

        $sendAccountRegistrationEmailMessageHandler(
            new SendAccountRegistrationEmailMessage(
                'user@example.com',
                'en_US',
                'CHANNEL_CODE'
            )
        );

        self::assertEmailCount(1);
        $email = self::getMailerMessage();
        self::assertEmailAddressContains($email, 'To', 'user@example.com');
        self::assertEmailHtmlBodyContains(
            $email,
            $translator->trans('email.user_registration.start_shopping', [], null, 'en_US'),
        );
    }

    public function testItSendsAccountRegistrationEmailWithoutHostname(): void
    {
        $container = self::getContainer();

        /** @var TranslatorInterface $translator */
        $translator = $container->get('translator');

        $emailSender = $container->get('email_sender');

        /** @var ChannelRepositoryInterface|ObjectProphecy $channelRepository */
        $channelRepository = $this->prophesize(ChannelRepositoryInterface::class);
        /** @var VendorRepositoryInterface|ObjectProphecy $userRepository */
        $userRepository = $this->prophesize(VendorRepositoryInterface::class);
        /** @var VendorChannelInterface|ObjectProphecy $channel */
        $channel = $this->prophesize(VendorChannelInterface::class);
        /** @var UserInterface|ObjectProphecy $user */
        $user = $this->prophesize(UserInterface::class);

        $user->getUsername()->willReturn('username');
        $user->getEmailVerificationToken()->willReturn('token');

        $channelRepository->findOneByCode('CHANNEL_CODE')->willReturn($channel->reveal());
        $userRepository->findOneByEmail('user@example.com')->willReturn($user->reveal());

        $sendAccountRegistrationEmailHandler = new SendAccountRegistrationEmailMessageHandler(
            $userRepository->reveal(),
            $channelRepository->reveal(),
            $emailSender
        );

        $sendAccountRegistrationEmailHandler(
            new SendAccountRegistrationEmail(
                'user@example.com',
                'en_US',
                'CHANNEL_CODE'
            )
        );

        self::assertEmailCount(1);
        $email = self::getMailerMessage();
        self::assertEmailAddressContains($email, 'To', 'user@example.com');
        self::assertEmailHtmlBodyContains(
            $email,
            $translator->trans('email.user_registration.start_shopping', [], null, 'en_US'),
        );
    }
}
