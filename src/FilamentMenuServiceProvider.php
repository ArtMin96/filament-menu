<?php

namespace Minasyans\FilamentMenu;

use Filament\PluginServiceProvider;
use Minasyans\FilamentMenu\Pages\ViewMenu;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource;
use Spatie\LaravelPackageTools\Package;

class FilamentMenuServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-menu';

//    protected array $pages = [
//        ViewMenu::class
//    ];

    public function boot(): FilamentMenuServiceProvider
    {
        if (config('filament-menu.auto_load_migrations', true)) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        return parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        $package->name('filament-menu')
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasMigration('create_filament_menu_table');
    }

    protected function getResources(): array
    {
        return [
            FilamentMenuResource::class,
        ];
    }
}
