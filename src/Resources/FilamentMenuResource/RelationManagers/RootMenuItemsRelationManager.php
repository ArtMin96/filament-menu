<?php

namespace Minasyans\FilamentMenu\Resources\FilamentMenuResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Illuminate\Http\Request;
use Minasyans\FilamentMenu\FilamentMenu;

class RootMenuItemsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'rootMenuItems';

    protected static ?string $recordTitleAttribute = 'menu_id';

//    protected static string $view = 'filament-menu::filament.pages.menu-items';

    protected static ?string $title = 'Menu items';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            Select::make('class')->options(static::getMenuItemTypes()),
            Select::make('locale')->options(static::getLocales()),
        ]);
    }

    public static function getMenuItemTypes()
    {
        $itemTypes = config('filament-menu.menu_item_types');

        $collect = collect($itemTypes)->mapWithKeys(function ($type) {
            return [$type => static::filterTypesClass($type)];
        })->all();

        return $collect;
    }

    private static function getLocales()
    {
        return config('filament-menu.locales');
    }

    private static function filterTypesClass(?string $classname): string
    {
        if ($classname === null) {
            return '';
        }

        // Using reflection class to obtain class info dynamically
        $reflection = new \ReflectionClass($classname);

        return app($reflection->getName())::getName();
    }
}
