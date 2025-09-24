<?php
namespace App\Tests\Command\Workflow;

use App\Command\Workflow\SystemMaintainCommand;
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

class SystemMaintainCommandTest extends TestCase {
    public function testWorkflowInvokesSubcommandsWithSnapshot() {
        $workflow = new SystemMaintainCommand();
        $app = new MockApplication();
        $workflow->setApplication($app);

        $input = new ArrayInput(['--days' => 10]);
        $output = new BufferedOutput();

        $status = $workflow->run($input, $output);

        $this->assertEquals(0, $status);
        $this->assertEquals(
            ['app:system:cleanup', 'app:system:healthcheck', 'app:system:metrics:export'],
            $app->called
        );

        $actual = trim($output->fetch());
        $expected = <<<SNAP
Running system maintenance with cleanup older than 10 days.
Mock executed: app:system:cleanup
Mock executed: app:system:healthcheck
Mock executed: app:system:metrics:export
SNAP;

        $this->assertEquals($expected, $actual);
    }
}