<div wire:sortable-group.item="{{ $item['id'] }}" :wire:key="{{ $item['id'] }}">
    <div class="border list-none rounded-sm px-3 py-3 bg-white">
        {{ $item['name'] }}
        <div>
            @if(!empty($item['children']))
                <button wire:sortable-group.handle>drag group</button>
            @else
                <button wire:sortable.handle>drag item</button>
            @endif
        </div>
    </div>

    <ul wire:sortable-group.item-group="{{ $item['id'] }}" class="pl-12">
        @if(isset($item['children']))
            @foreach($item['children'] as $menuItem)
                <livewire:menu-builder-single-item
                    :item="$menuItem"
                    wire:key="$menuItem['id']"
                />
            @endforeach
        @endif
    </ul>
</div>
