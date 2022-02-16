<?php

namespace Minasyans\FilamentMenu\Http\Livewire;

use Livewire\Component;

class MenuBuilderHeader extends Component
{
    public string $localeKey;

    public function changeLocale($locale)
    {
        $this->localeKey = $locale;
        $this->emit('menuItemsByLocale', $locale);
//        $this->emit('$refresh');
    }

    public function render()
    {
        return view('filament-menu::livewire.menu-builder-header');
    }
}
