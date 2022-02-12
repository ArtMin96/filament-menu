<?php

namespace Minasyans\FilamentMenu\Resources;

trait TranslatesLabels
{
    public static function getLabel(): string
    {
        return __(parent::getLabel());
    }

    public static function getPluralLabel(): string
    {
        return __(parent::getPluralLabel());
    }
}
