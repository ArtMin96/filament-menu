<?php

namespace Minasyans\FilamentMenu\Pages;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;
use Minasyans\FilamentMenu\FilamentMenuBuilder;
use Minasyans\FilamentMenu\MenuItemTypes\MenuItemStaticURLType;
use Minasyans\FilamentMenu\Models\FilamentMenu;

class ViewMenu extends Page
{
    protected static string $view = 'filament-menu::filament.pages.menus';

    public ?FilamentMenu $record;

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getSlug(): string
    {
        return '/menus/{record}';
    }

    protected function getTitle(): string
    {
        return $this->record->name . ' (' . $this->record->slug . ')';
    }

    protected function getActions(): array | View | null
    {
        return [
            ButtonAction::make('create-filament-menu-item')
                ->label('Add menu item')
                ->color('secondary')
                ->action('saveMenuItem')
                ->form([
                    TextInput::make('name')
                        ->required(),
                    Select::make('locale')
                        ->label('Locale')
                        ->options(FilamentMenuBuilder::getLocales())
                        ->required(),
                    Select::make('class')
                        ->label('Type')
                        ->options(FilamentMenuBuilder::getMenuItemTypes())
                        ->required()
                        ->reactive(),
                    Toggle::make('enabled')
                        ->label('Active')
                        ->inline()
                        ->default(true),
                    TextInput::make('value')
                        ->label('URL')
                        ->hidden(fn (Closure $get): bool => $get('class') !== MenuItemStaticURLType::class)
                        ->required(fn (Closure $get): bool => $get('class') === MenuItemStaticURLType::class)
                ])
        ];
    }

    public function saveMenuItem($data)
    {
        $menuItemModel = FilamentMenuBuilder::getMenuItemClass();
        $data['order'] = $menuItemModel::max('id') + 1;

        $model = new $menuItemModel;
        $model->menu_id = $this->record->id;
        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }
        $model->save();

        return $model;
    }

    public function openFilamentMenuItemModal(): void
    {
        $this->dispatchBrowserEvent('open-modal', ['id' => 'filament-menu-item-create']);
    }

    public function create()
    {
        $this->notify('success', 'Created!');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-event', ['id' => 'filament-menu-item-create']);
    }
}
