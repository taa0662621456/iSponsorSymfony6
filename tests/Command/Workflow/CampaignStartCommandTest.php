<?php
namespace App\Tests\Command\Workflow;

use App\Command\Workflow\CampaignStartCommand;
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

class CampaignStartCommandTest extends TestCase {
    public function testWorkflowInvokesSubcommandsWithSnapshot() {
        $workflow = new CampaignStartCommand();
        $app = new MockApplication();
        $workflow->setApplication($app);

        $input = new ArrayInput([
            'promotionId' => 77,
            '--coupon-count' => 50
        ]);
        $output = new BufferedOutput();

        $status = $workflow->run($input, $output);

        $this->assertEquals(0, $status);
        $this->assertEquals(
            ['app:promotion:apply', 'app:coupon:bulk-generate', 'app:report:sales'],
            $app->called
        );

        $actual = trim($output->fetch());
        $expected = <<<SNAP
Starting campaign for promotion 77
Generating 50 coupons...
Mock executed: app:promotion:apply
Mock executed: app:coupon:bulk-generate
Mock executed: app:report:sales
SNAP;

        $this->assertEquals($expected, $actual);
    }
}