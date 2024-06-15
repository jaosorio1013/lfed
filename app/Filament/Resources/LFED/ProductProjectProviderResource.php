<?php

namespace App\Filament\Resources\LFED;

use App\Filament\Resources\LFED\ProductProjectProviderResource\Pages;
use App\Models\ProductProjectProvider;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductProjectProviderResource extends Resource
{
    protected static ?string $model = ProductProjectProvider::class;

    protected static ?string $slug = 'l-f-e-d/product-project-providers';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('parent_id')
                    ->integer(),

                Select::make('project_id')
                    ->relationship('project', 'name')
                    ->searchable()
                    ->required(),

                Select::make('provider_id')
                    ->relationship('provider', 'name')
                    ->searchable()
                    ->required(),

                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable(),

                TextInput::make('product_category_id')
                    ->integer(),

                Checkbox::make('has_materiales'),

                Checkbox::make('has_transporte'),

                Checkbox::make('has_suministro'),

                Checkbox::make('has_instalacion'),

                TextInput::make('quantity')
                    ->numeric(),

                TextInput::make('price_per_unit')
                    ->numeric(),

                TextInput::make('total')
                    ->numeric(),

                DatePicker::make('valid_until'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?ProductProjectProvider $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?ProductProjectProvider $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('parent_id'),

                TextColumn::make('project.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('provider.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('product.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('product_category_id'),

                TextColumn::make('has_materiales'), // IconColumn

                TextColumn::make('has_transporte'),

                TextColumn::make('has_suministro'),

                TextColumn::make('has_instalacion'),

                TextColumn::make('quantity'),

                TextColumn::make('price_per_unit'),

                TextColumn::make('total'),

                TextColumn::make('valid_until')
                    ->date(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductProjectProviders::route('/'),
            'create' => Pages\CreateProductProjectProvider::route('/create'),
            'edit' => Pages\EditProductProjectProvider::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['category', 'product', 'project', 'provider']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['category.name', 'product.name', 'project.name', 'provider.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->category) {
            $details['Category'] = $record->category->name;
        }

        if ($record->product) {
            $details['Product'] = $record->product->name;
        }

        if ($record->project) {
            $details['Project'] = $record->project->name;
        }

        if ($record->provider) {
            $details['Provider'] = $record->provider->name;
        }

        return $details;
    }
}
