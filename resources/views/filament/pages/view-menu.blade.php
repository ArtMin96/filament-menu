<x-filament::page :widget-record="$record" class="filament-resources-view-record-page">

    <x-filament::card>
        {{ $this->form }}
    </x-filament::card>

    @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament::hr />

        <x-filament::resources.relation-managers :active-manager="$activeRelationManager" :managers="$relationManagers" :owner-record="$record" />
    @endif
</x-filament::page>
