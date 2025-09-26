<?php

namespace App\DataFixtures\Security;

use App\Entity\Security\SecuritySmsCode;
use App\Entity\Vendor\SecurityApiToken;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class SecurityFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $sms = new SecuritySmsCode();
        $sms->setCode('123456');
        $manager->persist($sms);

        $api = new SecurityApiToken();
        $api->setToken('apitoken-abc');
        $manager->persist($api);

        $this->addReference('security_sms', $sms);
        $this->addReference('security_api', $api);

        $manager->flush();
    }

    public static function getGroup(): string { return 'core'; }
    public static function getPriority(): int { return 5; }
}

