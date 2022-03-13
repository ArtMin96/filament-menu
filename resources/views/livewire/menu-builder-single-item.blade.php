<div wire:sortable-group.item="{{ $item->id }}" wire:key="task-{{ $item->id }}">
    <div class="flex flex-wrap bg-white shadow-sm border rounded-md outline-none hover:bg-gray-300 p-4 mb-3">
        <div class="w-2/3 flex items-center">
            <div class="text-lg mr-3">{{ $item->name }}</div>

            @if($item->class === \Minasyans\FilamentMenu\MenuItemTypes\MenuItemStaticURLType::class && $item->value)
                <div class="ml-3 text-sm text-gray-600">{{ $item->value }}</div>
            @endif

{{--        <div>--}}
{{--            @if(!$item->children->isEmpty())--}}
{{--                <button wire:sortable-group.handle>drag group 2</button>--}}
{{--            @else--}}
{{--                <button wire:sortable.handle>drag item 2</button>--}}
{{--            @endif--}}
{{--        </div>--}}
        </div>
    </div>

    @if(!$item->children->isEmpty())
        <ul wire:sortable-group.item-group="{{ $item->id }}" class="pl-12">
            @foreach($item->children as $menuItem)
                <livewire:menu-builder-single-item
                    :item="$menuItem"
                    wire:key="task-{{ wireKey($menuItem->id) }}"
                />
            @endforeach
        </ul>
    @endif
</div>
