<?php

namespace App\Service\Setup\Requirement;

use Symfony\Contracts\Translation\TranslatorInterface;

final class FilesystemRequirements extends RequirementCollection
{
    /**
     * @param TranslatorInterface $translator
     * @param string $cacheDir
     * @param string $logsDir
     * @param string|null $rootDir Deprecated.
     */
    public function __construct(TranslatorInterface $translator, string $cacheDir, string $logsDir, string $rootDir = null)
    {
        parent::__construct($translator->trans('installer.filesystem.header', []));

        if (func_num_args() >= 4) {
            @trigger_error(sprintf(
                'Passing root directory to "%s" constructor as the second argument is deprecated since 1.2 ' .
                'and this argument will be removed in 2.0.',
                self::class,
            ), \E_USER_DEPRECATED);

            [$rootDir, $cacheDir, $logsDir] = [$cacheDir, $logsDir, $rootDir];
        }

        $this
            ->add(new Requirement(
                $translator->trans('installer.filesystem.cache.header', []),
                is_writable($cacheDir),
                true,
                $translator->trans('installer.filesystem.cache.help', ['%path%' => $cacheDir]),
            ))
            ->add(new Requirement(
                $translator->trans('installer.filesystem.logs.header', []),
                is_writable($logsDir),
                true,
                $translator->trans('installer.filesystem.logs.help', ['%path%' => $logsDir]),
            ))
        ;
    }
}
