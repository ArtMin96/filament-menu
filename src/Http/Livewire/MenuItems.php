<?php

namespace Minasyans\FilamentMenu\Http\Livewire;

use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Minasyans\FilamentMenu\FilamentMenuBuilder;
use Minasyans\FilamentMenu\Models\FilamentMenu;
use Minasyans\FilamentMenu\Models\FilamentMenuItems;

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
        dd($items);
        $i = 1;
        foreach ($items as $item) {
            (new FilamentMenuBuilder)->saveMenuItemWithNewOrder($i, $item);
            $i++;
        }

        Filament::notify('success', 'Group inside another group saved');
//        dd('menu items', $items);
    }

    public function updateGroupOrder($items)
    {
        foreach ($items as $item) {
            $menuItem = FilamentMenuBuilder::getMenuItemClass()::find($item['value']);
            $menuItem->order = $item['order'];
            $menuItem->save();
        }

        $this->emit('menuItemsByLocale', 'en');

        Filament::notify('success', 'Group saved');
    }

    public function render(): View
    {
        return view('filament-menu::livewire.menu-items');
    }
}
