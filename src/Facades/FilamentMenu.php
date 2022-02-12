<?php

namespace Minasyans\FilamentMenu\Facades;

use Illuminate\Support\Facades\Facade;

class FilamentMenu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'filament-menu';
    }
}
