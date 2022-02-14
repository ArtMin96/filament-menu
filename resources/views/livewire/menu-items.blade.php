<div class="menu-builder-header">
    @livewire('menu-builder-header')

    <div wire:sortable="updateGroupOrder" wire:sortable-group="updateItemOrder" class="w-full">
        @foreach($menuItems as $key => $menuItem)
            <div wire:sortable.item="{{ $menuItem['id'] }}" wire:key="group-{{ $menuItem['id'] }}">
                <div class="border list-none rounded-sm px-3 py-3 bg-gray-600 mb-4">
                    - {{ $menuItem['name'] }}
                    <div>
                        @if(!empty($menuItem['children']))
                            <button wire:sortable-group.handle>drag group</button>
                        @else
                            <button wire:sortable.handle>drag item</button>
                        @endif
                    </div>
                </div>

                <ul wire:sortable-group.item-group="{{ $menuItem['id'] }}" class="pl-12">
                    @if(isset($menuItem['children']))
                        @foreach($menuItem['children'] as $item)
                            <livewire:menu-builder-single-item
                                :item="$item"
                                wire:key="$item['id']"
                            />
                        @endforeach
                    @endif
                </ul>

            </div>
        @endforeach
    </div>
</div>
