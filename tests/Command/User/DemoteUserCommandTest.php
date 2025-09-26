<?php
namespace App\Tests\Command\User;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class DemoteUserCommandTest extends KernelTestCase
{
    public function testDemoteUserCommand(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);
        $command = $application->find('app:user:demote');
        $tester = new CommandTester($command);

        $tester->execute(['email' => 'test@example.com', 'role' => 'ROLE_USER']);
        $this->assertStringContainsString('User demoted', $tester->getDisplay());
    }
}
