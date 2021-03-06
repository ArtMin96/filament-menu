<?php

namespace Minasyans\FilamentMenu\Models;

use Illuminate\Database\Eloquent\Model;
use Minasyans\FilamentMenu\FilamentMenuBuilder;

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
    }
}
