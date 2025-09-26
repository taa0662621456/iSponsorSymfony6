<?php
namespace App\Tests\Command\Workflow;

use App\Command\Workflow\RefundWorkflowCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class MockCommand extends Command {
    protected function execute($input, $output): int {
        $output->writeln("Mock executed: ".$this->getName());
        return Command::SUCCESS;
    }
}

class MockApplication extends Application {
    public array $called = [];
    public function find(string $name): Command {
        $cmd = new MockCommand($name);
        $this->called[] = $name;
        return $cmd;
    }
}

class RefundWorkflowCommandTest extends TestCase {
    public function testWorkflowInvokesSubcommandsWithSnapshot() {
        $workflow = new RefundWorkflowCommand();
        $app = new MockApplication();
        $workflow->setApplication($app);

        $input = new ArrayInput(['orderId' => 321]);
        $output = new BufferedOutput();

        $status = $workflow->run($input, $output);

        $this->assertEquals(0, $status);
        $this->assertEquals(['app:order:refund', 'app:payment:retry'], $app->called);

        $actual = trim($output->fetch());
        $expected = <<<SNAP
Refund workflow for order 321
Mock executed: app:order:refund
Mock executed: app:payment:retry
SNAP;

        $this->assertEquals($expected, $actual);
    }
}