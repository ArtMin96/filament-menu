<?php

namespace Minasyans\FilamentMenu\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\IconButtonAction;
use Filament\Tables\Columns\TextColumn;
use Minasyans\FilamentMenu\Models\FilamentMenu;
use Minasyans\FilamentMenu\Pages\ViewMenu;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages\CreateMenu;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages\EditMenus;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages\ListMenus;
//use Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages\ViewMenu;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource\RelationManagers\RootMenuItemsRelationManager;

class FilamentMenuResource extends Resource
{
    protected static ?string $model = FilamentMenu::class;

    protected static ?string $slug = 'menus';

    protected static ?string $navigationIcon = 'heroicon-o-table';

    protected static ?string $pluralLabel = 'Menus';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getPages(): array
    {
        return [
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
//            'view' => ViewMenu::class,
//            'view' => ViewMenu::route('/{record}'),
            'edit' => EditMenus::route('/{record}/edit'),
        ];
    }

    public static function table(Table $table): Table
    {
//        dd(\Minasyans\FilamentMenu\Pages\ViewMenu::getSlug());
//        dd(\Minasyans\FilamentMenu\Pages\ViewMenu::getUrl(['record' => 3]));
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('slug')->sortable(),
            ])->defaultSort('name')->pushActions([
                IconButtonAction::make('view')
                    ->label('View menu')
                    ->url(fn (FilamentMenu $record): string => url(ViewMenu::getUrl(['record' => $record])))
//                    ->url(fn (FilamentMenu $record): string => route('filament.resources.menus.view', $record))
                    ->icon('heroicon-o-eye')
                    ->color('dark'),

                IconButtonAction::make('edit')
                    ->label('Edit menu')
                    ->url(fn (FilamentMenu $record): string => route('filament.resources.menus.edit', $record))
                    ->icon('heroicon-o-pencil')
                    ->color('dark'),

                IconButtonAction::make('delete')
                    ->label('Delete menu')
                    ->url(fn (FilamentMenu $record): string => route('filament.resources.menus.edit', $record))
                    ->requiresConfirmation()
                    ->icon('heroicon-o-trash')
                    ->color('dark'),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('slug')
                    ->required()
                    ->unique(ignorable: fn (?FilamentMenu $record): ?FilamentMenu => $record)
                    ->options(collect(config('filament-menu.menus'))->mapWithKeys(fn ($option, $value) => [$value => $option['name']])->toArray())
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RootMenuItemsRelationManager::class
        ];
    }
}
