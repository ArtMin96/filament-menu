<?php

namespace Minasyans\FilamentMenu;

class FilamentMenuBuilder
{
    public static function getMenusTableName()
    {
        return config('filament-menu.menus_table_name', 'filament_menu_menus');
    }

    public static function getMenuItemsTableName()
    {
        return config('filament-menu.menu_items_table_name', 'filament_menu_menu_items');
    }

    public static function getMenuClass()
    {
        return config('filament-menu.menu_model', \Minasyans\FilamentMenu\Models\FilamentMenu::class);
    }

    public static function getMenuItemClass()
    {
        return config('filament-menu.menu_item_model', \Minasyans\FilamentMenu\Models\FilamentMenuItems::class);
    }

    public static function getMenus()
    {
        return config('filament-menu.menus', []);
    }

    public static function getMenuConfig($slug)
    {
        return config("filament-menu.menus.$slug", []);
    }

    public static function getMenuItemTypes()
    {
        $itemTypes = config('filament-menu.menu_item_types', []);

        return collect($itemTypes)->mapWithKeys(function ($type) {
            return [$type => static::filterTypesClass($type)];
        })->all();
    }

    public static function getLocales()
    {
        return config('filament-menu.locales', []);
    }

    public function saveMenuItemWithNewOrder($orderNr, $menuItemData, $parentId = null)
    {
        $menuItem = FilamentMenuBuilder::getMenuItemClass()::find($menuItemData->id);
        $menuItem->order = $orderNr;
        $menuItem->parent_id = $parentId;
        $menuItem->save();
        static::recursivelyOrderChildren($menuItemData);
    }

    public static function recursivelyOrderChildren($menuItem)
    {
        if (count($menuItem->children) > 0) {
            foreach ($menuItem->children as $i => $child) {
                (new FilamentMenuBuilder)->saveMenuItemWithNewOrder($i + 1, $child, $menuItem->id);
            }
        }
    }

    /**
     * @throws \ReflectionException
     */
    private static function filterTypesClass(?string $classname): string
    {
        if ($classname === null) {
            return '';
        }

        // Using reflection class to obtain class info dynamically
        $reflection = new \ReflectionClass($classname);

        return app($reflection->getName())::getName();
    }
}
