<?php

namespace Minasyans\FilamentMenu\Http\Livewire;

use Livewire\Component;
use Minasyans\FilamentMenu\Models\FilamentMenu;

class MenuItems extends Component
{
    public FilamentMenu $menu;

    public $menuItems = [];

    protected $listeners = [
        'menuItemsByLocale',
    ];

    public function menuItemsByLocale($locale)
    {
        $this->menuItems = $this->menu->formatForLocale($locale)['menuItems'];
    }

    public function updateItemOrder($items)
    {
        dd($items);
    }

    public function updateGroupOrder($group)
    {
        dd($group);
    }

    public function render()
    {
        return view('filament-menu::livewire.menu-items', [
            'menuItems' => $this->menuItems
        ]);
    }
}
