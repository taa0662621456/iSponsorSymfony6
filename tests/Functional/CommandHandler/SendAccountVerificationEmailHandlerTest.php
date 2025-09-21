<?php

namespace App\Tests\Functional\CommandHandler;

use App\Message\SendAccountVerificationEmailMessage;
use App\MessageHandler\SendAccountVerificationEmailMessageHandler;
use App\RepositoryInterface\ChannelRepositoryInterface;
use App\RepositoryInterface\UserRepositoryInterface;
use App\EntityInterface\Channel\ChannelInterface;
use App\EntityInterface\User\UserInterface;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

final class SendAccountVerificationEmailHandlerTest extends KernelTestCase
{
    use ProphecyTrait;

    public function testItSendsAccountVerificationTokenEmailWithoutHostname(): void
    {
        $container = self::getContainer();

        /** @var TranslatorInterface $translator */
        $translator = $container->get(TranslatorInterface::class);
        $emailSender = $container->get('email_sender');

        $channelRepository = $this->prophesize(ChannelRepositoryInterface::class);
        $userRepository = $this->prophesize(UserRepositoryInterface::class);
        $channel = $this->prophesize(ChannelInterface::class);
        $user = $this->prophesize(UserInterface::class);

        $user->getUsername()->willReturn('username');
        $user->getEmailVerificationToken()->willReturn('token');

        $channelRepository->findOneByCode('CHANNEL_CODE')->willReturn($channel->reveal());
        $userRepository->findOneByEmail('user@example.com')->willReturn($user->reveal());

        $handler = new SendAccountVerificationEmailMessageHandler(
            $userRepository->reveal(),
            $channelRepository->reveal(),
            $emailSender
        );

        $handler(new SendAccountVerificationEmailMessage(
            'user@example.com',
            'en_US',
            'CHANNEL_CODE'
        ));

        self::assertEmailCount(1);
        $email = self::getMailerMessage();
        self::assertEmailAddressContains($email, 'To', 'user@example.com');
        self::assertEmailHtmlBodyContains(
            $email,
            $translator->trans('email.verification_token.verify_your_email_address', [], null, 'en_US'),
        );
    }

    public function testItSendsAccountVerificationTokenEmailWithHostname(): void
    {
        $container = self::getContainer();

        /** @var TranslatorInterface $translator */
        $translator = $container->get(TranslatorInterface::class);
        $emailSender = $container->get('email_sender');

        $channelRepository = $this->prophesize(ChannelRepositoryInterface::class);
        $userRepository = $this->prophesize(UserRepositoryInterface::class);
        $channel = $this->prophesize(ChannelInterface::class);
        $user = $this->prophesize(UserInterface::class);

        $user->getUsername()->willReturn('username');
        $user->getEmailVerificationToken()->willReturn('token');

        $channelRepository->findOneByCode('CHANNEL_CODE')->willReturn($channel->reveal());
        $userRepository->findOneByEmail('user@example.com')->willReturn($user->reveal());

        $handler = new SendAccountVerificationEmailMessageHandler(
            $userRepository->reveal(),
            $channelRepository->reveal(),
            $emailSender
        );

        $handler(new SendAccountVerificationEmailMessage(
            'user@example.com',
            'en_US',
            'CHANNEL_CODE'
        ));

        self::assertEmailCount(1);
        $email = self::getMailerMessage();
        self::assertEmailAddressContains($email, 'To', 'user@example.com');
        self::assertEmailHtmlBodyContains(
            $email,
            $translator->trans('email.verification_token.verify_your_email_address', [], null, 'en_US'),
        );
    }
}
