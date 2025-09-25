<?php

namespace App\DataFixtures\Project;

use App\Entity\Project\ProjectReview;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProjectReviewFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $project = $this->getReference('project_1');

        $review = new ProjectReview();
        $review->setRating(5);
        $review->setComment('Excellent initiative!');
        $review->setProject($project);

        $manager->persist($review);
        $this->addReference('projectReview_1', $review);

        $manager->flush();
    }

    public static function getGroup(): string { return 'project'; }
    public static function getPriority(): int { return 60; }
}
