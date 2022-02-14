<?php

namespace Minasyans\FilamentMenu;

use Filament\PluginServiceProvider;
use Livewire\Livewire;
use Minasyans\FilamentMenu\Http\Livewire\MenuBuilderHeader;
use Minasyans\FilamentMenu\Http\Livewire\MenuBuilderSingleItem;
use Minasyans\FilamentMenu\Http\Livewire\MenuItems;
use Minasyans\FilamentMenu\Pages\ViewMenu;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource;
use Spatie\LaravelPackageTools\Package;

class FilamentMenuServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-menu';

    protected array $pages = [
        ViewMenu::class
    ];

    protected array $scripts = [
        'livewire-sortable' => __DIR__ . '/../resources/assets/js/livewire-sortable.js',
    ];

    public function boot(): FilamentMenuServiceProvider
    {
        if (config('filament-menu.auto_load_migrations', true)) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        Livewire::component('menu-items', MenuItems::class);
        Livewire::component('menu-builder-header', MenuBuilderHeader::class);
        Livewire::component('menu-builder-single-item', MenuBuilderSingleItem::class);

        return parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        $package->name('filament-menu')
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasRoutes('routes')
            ->hasMigration('create_filament_menu_table');
    }

    protected function getResources(): array
    {
        return [
            FilamentMenuResource::class,
        ];
    }
}
