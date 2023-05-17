<?php

namespace App\Dto;

use Webmozart\Assert\Assert;

trait TranslatebleDTOTrait
{
    public function getTranslatable()
    {
        $translatable = $this->translatable;

        // Return typehint should account for null value.
        Assert::notNull($translatable);

        return $translatable;
    }

    public function setTranslatable($translatable): void
    {
        if ($translatable === $this->translatable) {
            return;
        }

        $previousTranslatable = $this->translatable;
        $this->translatable = $translatable;

        $previousTranslatable?->removeTranslation($this);

        $translatable?->addTranslation($this);
    }

}
