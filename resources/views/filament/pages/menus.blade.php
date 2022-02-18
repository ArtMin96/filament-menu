<x-filament::page>
    <x-filament::card>
        <div class="flex border-b border-40 -mx-6 px-6">
            <div class="w-1/4 py-4">
                <h4 class="font-normal text-80">Name</h4>
            </div>
            <div class="w-3/4 py-4 break-words">
                <p class="text-90">
                    test
                </p>
            </div>
        </div>
    </x-filament::card>

    @livewire('menu-items', ['menu' => $this->record])

    <x-slot name="modals">
        <x-filament::modal id="filament-menu-item-create" width="lg">
            <x-slot name="heading">
                <h3 class="text-xl">{{ __('subheading') }}</h3>
            </x-slot>

{{--            {{ $this->form }}--}}

            <x-slot name="actions">
                <x-filament::modal.actions full-width>
                    <x-filament::button wire:click="closeModal" color="secondary">
                        {{ __('primary') }}
                    </x-filament::button>

                    <x-filament::button wire:click="create" color="primary">
                        {{ __('warning') }}
                    </x-filament::button>
                </x-filament::modal.actions>
            </x-slot>
        </x-filament::modal>
    </x-slot>
</x-filament::page>
