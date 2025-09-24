<?php
namespace App\Tests\Command\User;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class PromoteUserCommandTest extends KernelTestCase
{
    public function testPromoteUserCommand(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $command = $application->find('app:user:promote');
        $tester = new CommandTester($command);

        $tester->execute(['email' => 'test@example.com', 'role' => 'ROLE_ADMIN']);
        $this->assertStringContainsString('User promoted', $tester->getDisplay());
    }
}
