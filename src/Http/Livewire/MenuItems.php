<?php

namespace Minasyans\FilamentMenu\Http\Livewire;

use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Minasyans\FilamentMenu\Models\FilamentMenu;

class MenuItems extends Component
{
    public FilamentMenu $menu;

    public Collection $menuItems;

    protected $listeners = [
        'menuItemsByLocale',
    ];

    public function menuItemsByLocale($locale): void
    {
        $this->menuItems = $this->menu->formatForLocale($locale);
    }

    public function updateItemOrder($items)
    {
        Filament::notify('success', 'Saved');
//        dd('menu items', $items);
    }

    public function updateGroupOrder($group)
    {
        Filament::notify('success', 'Group saved');
    }

    public function render(): View
    {
        return view('filament-menu::livewire.menu-items');
    }
}
