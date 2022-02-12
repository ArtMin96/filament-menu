<?php

namespace Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource;

class ViewMenu extends ViewRecord
{
    protected static string $resource = FilamentMenuResource::class;

    protected static string $view = 'filament-menu::filament.pages.view-menu';


}
