<?php

namespace App\Service\Setup\Requirement;

use Symfony\Contracts\Translation\TranslatorInterface;

final class SettingsRequirements extends RequirementCollection
{
    public const RECOMMENDED_PHP_VERSION = '7.0';

    public function __construct(TranslatorInterface $translator)
    {
        parent::__construct($translator->trans('installer.setting.header', []));

        $this
            ->add(new Requirement(
                $translator->trans('installer.setting.timezone'),
                $this->isOn('date.timezone'),
                true,
                $translator->trans('installer.setting.timezone_help'),
            ))
            ->add(new Requirement(
                $translator->trans('installer.setting.version_recommended'),
                version_compare(\PHP_VERSION, self::RECOMMENDED_PHP_VERSION, '>='),
                false,
                $translator->trans('installer.setting.version_help', [
                    '%current%' => \PHP_VERSION,
                    '%recommended%' => self::RECOMMENDED_PHP_VERSION,
                ]),
            ))
            ->add(new Requirement(
                $translator->trans('installer.setting.detect_unicode'),
                !$this->isOn('detect_unicode'),
                false,
                $translator->trans('installer.setting.detect_unicode_help'),
            ))
            ->add(new Requirement(
                $translator->trans('installer.setting.session.auto_start'),
                !$this->isOn('session.auto_start'),
                false,
                $translator->trans('installer.setting.session.auto_start_help'),
            ))
        ;
    }

    private function isOn(string $key): bool
    {
        $value = ini_get($key);

        return !empty($value) && strtolower($value) !== 'off';
    }
}
