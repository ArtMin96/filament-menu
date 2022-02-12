<?php

namespace Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource;

class ListMenus extends ListRecords
{
    protected static string $resource = FilamentMenuResource::class;

    protected static ?string $title = 'Menus';

}
