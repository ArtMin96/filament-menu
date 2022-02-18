<div class="menu-builder-page">

    <livewire:menu-builder-header />

    @if($menuItems)
        <x-filament::card>
            <div wire:sortable="updateGroupOrder" wire:sortable-group="updateItemOrder" class="w-full">
                @foreach($menuItems as $key => $menuItem)
                    @php
                        $wireKey = time().mt_rand(1000000000, 9999999999).$menuItem->id;
                    @endphp

                    <div wire:sortable.item="{{ $menuItem->id }}" wire:key="group-{{ $wireKey }}">
                        <div class="flex flex-wrap bg-gray-100 shadow-sm border rounded-md outline-none hover:bg-gray-300 p-4 mb-3">
                            <div class="w-2/3 flex items-center">
                                <div class="text-lg mr-3">{{ $menuItem->name }}</div>

                                @if($menuItem->class === \Minasyans\FilamentMenu\MenuItemTypes\MenuItemStaticURLType::class && $menuItem->value)
                                    <div class="ml-3 text-sm text-gray-600">{{ $menuItem->value }}</div>
                                @endif
                            </div>

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
        </x-filament::card>
    @endif
</div>
