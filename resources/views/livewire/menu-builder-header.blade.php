<div class="locale-selection px-6 mr-4 bg-white rounded-md flex justify-between items-center">
    <x-filament::header>
        <x-slot name="heading">
            Menu items
        </x-slot>
    </x-filament::header>

    <div class="flex items-center">
        @foreach(config('filament-menu.locales') as $key => $locale)
            <div class="mx-2 cursor-pointer font-bold px-2 h-full flex items-center @if($localeKey === $key) text-blue-400 border-b-4 border-indigo-500 @endif"
                 wire:click="changeLocale('{{ $key }}')"
            >
                <span>{{ $locale }} ({{ $key }})</span>
            </div>
        @endforeach
    </div>
</div>
