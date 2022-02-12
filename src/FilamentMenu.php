<?php

namespace Minasyans\FilamentMenu;

class FilamentMenu
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

    public static function getMenuItemTypes()
    {
        return config('filament-menu.menu_item_types', []);
    }

    public static function getMenus()
    {
        return config('filament-menu.menus', []);
    }

    public static function getMenuConfig($slug)
    {
        return config("filament-menu.menus.$slug", []);
    }
}
