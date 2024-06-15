<?php

namespace App\Filament\Resources\LFED;

use App\Filament\Resources\LFED\PersonResource\Pages;
use App\Models\Person;
use Filament\Forms\Components\Checkbox;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $slug = 'l-f-e-d/people';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('identification_type')
                    ->options([
                        Person::IDENTIFICATION_TYPE_CEDULA => 'Cédula',
                        Person::IDENTIFICATION_TYPE_NIT => 'NIT',
                        Person::IDENTIFICATION_TYPE_PASAPORTE => 'Pasaporte',
                    ])
                    ->default(Person::IDENTIFICATION_TYPE_CEDULA),

                TextInput::make('identification_number')
                    ->required(),

                TextInput::make('name')
                    ->required(),

                TextInput::make('phone')
                    ->required(),

                TextInput::make('email'),

                TextInput::make('address'),

                Checkbox::make('is_provider'),

                Checkbox::make('is_client')
                    ->default(true),

                Checkbox::make('is_active')
                    ->default(true),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Person $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Person $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('identification_type'),

                TextColumn::make('identification_number'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone'),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('address'),

                TextColumn::make('is_provider'),

                TextColumn::make('is_client'),

                TextColumn::make('is_active'),
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
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }
}
