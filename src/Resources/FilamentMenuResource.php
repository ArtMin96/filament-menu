<?php

namespace Minasyans\FilamentMenu\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\IconButtonAction;
use Filament\Tables\Columns\TextColumn;
use Minasyans\FilamentMenu\FilamentMenuBuilder;
use Minasyans\FilamentMenu\Models\FilamentMenu;
use Minasyans\FilamentMenu\Pages\ViewMenu;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages\CreateMenu;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages\EditMenu;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource\Pages\ListMenus;
use Minasyans\FilamentMenu\Resources\FilamentMenuResource\RelationManagers\RootMenuItemsRelationManager;

class FilamentMenuResource extends Resource
{
    protected static ?string $slug = 'menus';

    protected static ?string $navigationIcon = 'heroicon-o-table';

    protected static ?string $pluralLabel = 'Menus';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return FilamentMenuBuilder::getMenuClass();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
//            'view' => ViewMenu::route('/{record}'),
            'edit' => EditMenu::route('/{record}/edit'),
        ];
    }

    public static function table(Table $table): Table
    {
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
                    ->options(collect(FilamentMenuBuilder::getMenus())->mapWithKeys(fn ($option, $value) => [$value => $option['name']])->toArray())
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RootMenuItemsRelationManager::class
        ];
    }
}
