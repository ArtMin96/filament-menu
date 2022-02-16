<?php

namespace Minasyans\FilamentMenu\Models;

use Illuminate\Database\Eloquent\Model;
use Minasyans\FilamentMenu\FilamentMenu as FilamentMenuBuilder;

class FilamentMenu extends Model
{
    protected $table = 'filament_menu';

    protected $fillable = ['name', 'slug'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(FilamentMenuBuilder::getMenusTableName());
    }

    public function rootMenuItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this
            ->hasMany(FilamentMenuBuilder::getMenuItemClass(), 'menu_id')
            ->where('parent_id', null)
            ->orderBy('parent_id')
            ->orderBy('order')
            ->orderBy('name');
    }

    public function formatForLocale($locale)
    {
        return $this->rootMenuItems()
            ->where('locale', $locale)->get();
//        return [
//            'id' => $this->id,
//            'name' => $this->name,
//            'slug' => $this->slug,
//            'locale' => $locale,
//            'menuItems' => $this->rootMenuItems()
//                ->where('locale', $locale)
//                ->get()
//                ->map(function ($menuItem) {
//                    return $this->formatMenuItem($menuItem);
//                })
//        ];
    }

    public function formatMenuItem($menuItem)
    {
        return [
            'id' => $menuItem->id,
            'name' => $menuItem->name,
            'type' => $menuItem->type,
            'value' => $menuItem->customValue,
            'target' => $menuItem->target,
            'enabled' => $menuItem->enabled,
            'data' => $menuItem->customData,
            'children' => empty($menuItem->children) ? [] : $menuItem->children->map(function ($item) {
                return $this->formatMenuItem($item);
            })
        ];
    }
}
