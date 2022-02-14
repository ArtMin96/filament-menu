<?php

namespace Minasyans\FilamentMenu\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;
use Minasyans\FilamentMenu\Models\FilamentMenu;

class ViewMenu extends Page
{
    protected static string $view = 'filament-menu::filament.pages.menus';

    protected static ?string $slug = '/menus/{record}';

    protected static ?string $title = 'View menu';

    public FilamentMenu $record;

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }



    protected function getActions(): array | View | null
    {
        return [
            ButtonAction::make('')
                ->icon('heroicon-o-pencil')
                ->color('secondary')
                ->url('sdfsd')
        ];
    }
}
