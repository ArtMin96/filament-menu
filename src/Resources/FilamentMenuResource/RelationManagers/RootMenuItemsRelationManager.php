<?php

namespace Minasyans\FilamentMenu\Resources\FilamentMenuResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Illuminate\Http\Request;
use Minasyans\FilamentMenu\FilamentMenuBuilder;

class RootMenuItemsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'rootMenuItems';

    protected static ?string $recordTitleAttribute = 'menu_id';

    protected static string $view = 'filament-menu::filament.pages.menu-items';

    protected static ?string $title = 'Menu items';
}
