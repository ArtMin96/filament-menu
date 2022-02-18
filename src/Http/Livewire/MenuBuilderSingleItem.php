<?php

namespace Minasyans\FilamentMenu\Http\Livewire;

use Filament\Facades\Filament;
use Livewire\Component;
use Minasyans\FilamentMenu\FilamentMenuBuilder;
use Minasyans\FilamentMenu\Models\FilamentMenuItems;

class MenuBuilderSingleItem extends Component
{
    public $item;

    public function updateItemOrder($items)
    {
//        dd($items);

        $i = 1;
        foreach ($items as $item) {
            $menuItem = FilamentMenuBuilder::getMenuItemClass()::find($item['value']);

            (new FilamentMenuBuilder)->saveMenuItemWithNewOrder($i, $menuItem);
            $i++;
        }

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
