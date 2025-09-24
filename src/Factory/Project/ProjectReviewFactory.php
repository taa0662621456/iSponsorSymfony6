<?php

namespace App\Factory\Project;

use App\Entity\Project\ProjectReview;


class ProjectReviewFactory
{
    public function __invoke(): ProjectReview
    {
        return new ProjectReview();
    }


    public static function create(): ProjectReview
    {
        return new ProjectReview();
    }

}