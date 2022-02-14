<?php

namespace Minasyans\FilamentMenu\Http\Livewire;

use Livewire\Component;

class MenuBuilderHeader extends Component
{
    public string $locale;

    public function mount()
    {
        $this->locale = 'en';
    }

    public function changeLocale($locale)
    {
        $this->emit('menuItemsByLocale', $locale);
    }

    public function render()
    {
        return view('filament-menu::livewire.menu-builder-header');
    }
}
