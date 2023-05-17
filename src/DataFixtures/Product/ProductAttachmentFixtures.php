<?php

namespace App\DataFixtures\Product;



use App\DataFixtures\Category\CategoryAttachmentFixtures;
use App\DataFixtures\Category\CategoryEnGbFixtures;
use App\DataFixtures\Category\CategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\Project\ProjectAttachmentFixtures;
use App\DataFixtures\Project\ProjectEnGbFixtures;
use App\DataFixtures\Project\ProjectPlatformRewardFixtures;
use App\DataFixtures\Project\ProjectReviewFixtures;
use App\DataFixtures\Project\ProjectTagFixtures;
use App\DataFixtures\Project\ProjectTypeFixtures;
use App\DataFixtures\Vendor\VendorDocumentFixtures;
use App\DataFixtures\Vendor\VendorEnGbFixtures;
use App\DataFixtures\Vendor\VendorFixtures;
use App\DataFixtures\Vendor\VendorIbanFixtures;
use App\DataFixtures\Vendor\VendorMediaFixtures;
use App\DataFixtures\Vendor\VendorSecurityFixtures;


final class ProductAttachmentFixtures extends DataFixtures
{

	public function getOrder(): int
    {
		return 18;
	}

}
