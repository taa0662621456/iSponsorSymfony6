<?php

namespace App\Service\Setup\Requirement;

use DOMDocument;
use ReflectionExtension;
use Symfony\Contracts\Translation\TranslatorInterface;
use function defined;
use function extension_loaded;
use function function_exists;
use function ini_get;
use const INTL_ICU_VERSION;
use const PCRE_VERSION;

final class ExtensionsRequirements extends RequirementCollection
{
    public function __construct(TranslatorInterface $translator)
    {
        parent::__construct($translator->trans('installer.extensions.header'));

        $this
            ->add(new Requirement(
                $translator->trans('installer.extensions.json_encode'),
                function_exists('json_encode'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'JSON']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.session_start'),
                function_exists('session_start'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'session']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.ctype'),
                function_exists('ctype_alpha'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'ctype']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.token_get_all'),
                function_exists('token_get_all'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'JSON']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.simplexml_import_dom'),
                function_exists('simplexml_import_dom'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'SimpleXML']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.apc'),
                !(function_exists('apc_store') && ini_get('apc.enabled')) || version_compare(phpversion('apc'), '3.0.17', '>='),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'APC (>=3.0.17)']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.pcre'),
                defined('PCRE_VERSION') ? ((float) substr(PCRE_VERSION, 0, (int) strpos(PCRE_VERSION, ' '))) > 8.0 : false,
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'PCRE (>=8.0)']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.php_xml'),
                class_exists(DOMDocument::class),
                false,
                $translator->trans('installer.extensions.help', ['%extension%' => 'PHP-XML']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.mbstring'),
                function_exists('mb_strlen'),
                false,
                $translator->trans('installer.extensions.help', ['%extension%' => 'mbstring']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.iconv'),
                function_exists('iconv'),
                false,
                $translator->trans('installer.extensions.help', ['%extension%' => 'iconv']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.exif'),
                function_exists('exif_read_data'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'exif']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.intl'),
                extension_loaded('intl'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'intl']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.fileinfo'),
                extension_loaded('fileinfo'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'fileinfo']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.accelerator.header'),
                !empty(ini_get('opcache.enable')),
                false,
                $translator->trans('installer.extensions.accelerator.help'),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.pdo'),
                class_exists('PDO'),
                false,
                $translator->trans('installer.extensions.help', ['%extension%' => 'PDO']),
            ))
            ->add(new Requirement(
                $translator->trans('installer.extensions.gd'),
                defined('GD_VERSION'),
                true,
                $translator->trans('installer.extensions.help', ['%extension%' => 'gd']),
            ));

        if (extension_loaded('intl')) {
            if (defined('INTL_ICU_VERSION')) {
                $version = INTL_ICU_VERSION;
            } else {
                $reflector = new ReflectionExtension('intl');

                ob_start();
                $reflector->info();
                $output = strip_tags(ob_get_clean());

                preg_match('/^ICU version +(?:=> )?(.*)$/m', $output, $matches);
                $version = $matches[1];
            }

            $this->add(new Requirement(
                $translator->trans('installer.extensions.icu'),
                version_compare($version, '4.0', '>='),
                false,
                $translator->trans('installer.extensions.help', ['%extension%' => 'ICU (>=4.0)']),
            ));
        }
    }
}
