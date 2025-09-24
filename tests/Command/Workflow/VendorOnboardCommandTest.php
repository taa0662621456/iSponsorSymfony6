<?php
namespace App\Tests\Command\Workflow;

use App\Command\Workflow\VendorOnboardCommand;
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

class VendorOnboardCommandTest extends TestCase {
    public function testWorkflowInvokesSubcommandsWithSnapshot() {
        $workflow = new VendorOnboardCommand();
        $app = new MockApplication();
        $workflow->setApplication($app);

        $input = new ArrayInput([
            'vendorId' => 42,
            'managerEmail' => 'manager@example.com',
            'pricelistFile' => 'vendors.csv'
        ]);
        $output = new BufferedOutput();

        $status = $workflow->run($input, $output);

        $this->assertEquals(0, $status);
        $this->assertEquals(
            ['app:vendor:activate', 'app:user:assign-vendor', 'app:vendor:import-pricelist'],
            $app->called
        );

        $actual = trim($output->fetch());
        $expected = <<<SNAP
Onboarding vendor 42
Mock executed: app:vendor:activate
Mock executed: app:user:assign-vendor
Mock executed: app:vendor:import-pricelist
SNAP;

        $this->assertEquals($expected, $actual);
    }
}