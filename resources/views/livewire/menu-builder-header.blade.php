<div class="locale-selection px-6 mr-4 bg-white rounded-md flex justify-between items-center">
    <x-filament::header>
        <x-slot name="heading">
            Menu items
        </x-slot>
    </x-filament::header>

    <div class="flex items-center">
        @foreach(config('filament-menu.locales') as $key => $locale)
            <div class="mx-2 cursor-pointer font-bold border-b-2 px-2 h-full flex items-center box-border" wire:click="changeLocale('{{ $key }}')">
                <span>{{ $locale }} ({{ $key }})</span>
            </div>
        @endforeach
    </div>
</div>
