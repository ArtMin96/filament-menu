<div class="menu-builder-header">
    @livewire('menu-builder-header')

    @if($menuItems)
        <div wire:sortable="updateGroupOrder" wire:sortable-group="updateItemOrder" class="w-full">
            @foreach($menuItems as $key => $menuItem)
                @php
                    $wireKey = time().mt_rand(1000000000, 9999999999).$menuItem->id;
                @endphp

                <div wire:sortable.item="{{ $menuItem->id }}" wire:key="group-{{ $wireKey }}">
                    <div class="border list-none rounded-sm px-3 py-3 bg-gray-600 mb-4">
                        - {{ $menuItem->name }}
    {{--                    <div>--}}
    {{--                        @if(!$menuItem->children->isEmpty())--}}
    {{--                            <button wire:sortable-group.handle>drag group 1</button>--}}
    {{--                        @else--}}
    {{--                            <button wire:sortable.handle>drag item 1</button>--}}
    {{--                        @endif--}}
    {{--                    </div>--}}
                    </div>

                    @if(!$menuItem->children->isEmpty())
                        <ul wire:sortable-group.item-group="{{ $menuItem->id }}" class="pl-12">
                            @foreach($menuItem->children as $item)
                                @php
                                    $wireKey2 = time().mt_rand(1000000000, 9999999999).$item->id;
                                @endphp
                                <livewire:menu-builder-single-item
                                    :item="$item"
                                    wire:key="task-{{ $wireKey2 }}"
                                />
                            @endforeach
                        </ul>
                    @endif

                </div>
            @endforeach
        </div>
    @endif
</div>
