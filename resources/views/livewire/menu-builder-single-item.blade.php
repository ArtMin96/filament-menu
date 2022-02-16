<div wire:sortable-group.item="{{ $item->id }}" wire:key="task-{{ $item->id }}">
    <div class="border list-none rounded-sm px-3 py-3 bg-white">
        {{ $item->name }}

{{--        <div>--}}
{{--            @if(!$item->children->isEmpty())--}}
{{--                <button wire:sortable-group.handle>drag group 2</button>--}}
{{--            @else--}}
{{--                <button wire:sortable.handle>drag item 2</button>--}}
{{--            @endif--}}
{{--        </div>--}}
    </div>

    @if(!$item->children->isEmpty())
        <ul wire:sortable-group.item-group="{{ $item->id }}" class="pl-12">
            @foreach($item->children as $menuItem)
                @php
                    $wireKey3 = time().mt_rand(1000000000, 9999999999).$menuItem->id;
                @endphp

                <livewire:menu-builder-single-item
                    :item="$menuItem"
                    wire:key="task-{{ $wireKey3 }}"
                />
            @endforeach
        </ul>
    @endif
</div>
