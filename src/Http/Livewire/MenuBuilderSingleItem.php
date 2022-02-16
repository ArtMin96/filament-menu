<?php

namespace Minasyans\FilamentMenu\Http\Livewire;

use Filament\Facades\Filament;
use Livewire\Component;
use Minasyans\FilamentMenu\Models\FilamentMenuItems;

class MenuBuilderSingleItem extends Component
{
    public $item;

    public function updateItemOrder($items)
    {
        Filament::notify('success', 'Item saved!');
//        dd('single items', $items);
    }

    public function render()
    {
        return view('filament-menu::livewire.menu-builder-single-item', [
            'item' => $this->item
        ]);
    }
}
