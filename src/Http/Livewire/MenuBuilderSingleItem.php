<?php

namespace Minasyans\FilamentMenu\Http\Livewire;

use Livewire\Component;
use Minasyans\FilamentMenu\Models\FilamentMenuItems;

class MenuBuilderSingleItem extends Component
{
    public $item;

    public function updateItemOrder($items)
    {
        dd($items);
    }

    public function render()
    {
        return view('filament-menu::livewire.menu-builder-single-item', [
            'item' => $this->item
        ]);
    }
}
