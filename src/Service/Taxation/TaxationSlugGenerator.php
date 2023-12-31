<?php

namespace App\Service\Taxation;

use Webmozart\Assert\Assert;
use Behat\Transliterator\Transliterator;

final class TaxationSlugGenerator
{
    public function generate($taxon, string $locale = null): string
    {
        $name = $taxon->getTranslation($locale)->getName();

        Assert::notEmpty($name, 'Cannot generate slug without a name.');

        $slug = $this->transliterate($name);

        $parentTaxon = $taxon->getParent();
        if (null === $parentTaxon) {
            return $slug;
        }

        $parentSlug = $parentTaxon->getTranslation($locale)->getSlug() ?: $this->generate($parentTaxon, $locale);

        return $parentSlug.'/'.$slug;
    }

    private function transliterate(string $string): string
    {
        // Manually replacing apostrophes since Transliterate started removing them at v1.2.
        return Transliterator::transliterate(str_replace('\'', '-', $string));
    }
}
