<x-filament::page>
    <x-filament::card>
        <div class="flex border-b border-40 -mx-6 px-6"><div class="w-1/4 py-4"><h4 class="font-normal text-80">Name</h4></div> <div class="w-3/4 py-4 break-words"><p class="text-90">
                    test
                </p></div></div>
    </x-filament::card>

    @livewire('menu-items', ['menu' => $this->record])
</x-filament::page>
