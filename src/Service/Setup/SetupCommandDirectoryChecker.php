<?php

namespace App\Service\Setup;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

final class SetupCommandDirectoryChecker
{
    private ?string $name = null;

    public function __construct(private readonly Filesystem $filesystem)
    {
    }

    public function ensureDirectoryExists($directory, OutputInterface $output): void
    {
        if (is_dir($directory)) {
            return;
        }

        try {
            $this->filesystem->mkdir($directory, 0755);

            $output->writeln(sprintf('<comment>Created "%s" directory.</comment>', realpath($directory)));
        } catch (IOException) {
            $output->writeln('');
            $output->writeln('<error>Cannot run command due to unexisting directory (tried to create it automatically, failed).</error>');
            $output->writeln('');

            throw new \RuntimeException(sprintf(
                'Create directory "%s" and run command "<comment>%s</comment>"',
                realpath($directory),
                $this->name,
            ));
        }
    }

    public function ensureDirectoryIsWritable($directory, OutputInterface $output): void
    {
        if (is_writable($directory)) {
            return;
        }

        try {
            $this->filesystem->chmod($directory, 0755);

            $output->writeln(sprintf('<comment>Changed "%s" permissions to 0755.</comment>', realpath($directory)));
        } catch (IOException) {
            $output->writeln('');
            $output->writeln('<error>Cannot run command due to bad directory permissions (tried to change permissions to 0755).</error>');
            $output->writeln('');

            throw new \RuntimeException(sprintf(
                'Set "%s" writable and run command "<comment>%s</comment>"',
                realpath(dirname($directory)),
                $this->name,
            ));
        }
    }

    public function setCommandName(string $name): void
    {
        $this->name = $name;
    }
}
