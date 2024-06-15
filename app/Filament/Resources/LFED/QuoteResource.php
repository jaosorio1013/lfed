<?php

namespace App\Filament\Resources\LFED;

use App\Filament\Resources\LFED\QuoteResource\Pages;
use App\Models\Quote;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static ?string $slug = 'l-f-e-d/quotes';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->relationship('project', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('identification')
                    ->required(),

                TextInput::make('subtotal')
                    ->numeric(),

                TextInput::make('discount')
                    ->numeric(),

                TextInput::make('percentage_utilidad')
                    ->numeric(),

                TextInput::make('percentage_administracion')
                    ->numeric(),

                TextInput::make('percentage_inprevistos')
                    ->numeric(),

                TextInput::make('percentage_retefuente')
                    ->numeric(),

                DatePicker::make('valid_until'),

                DatePicker::make('sent_at')
                    ->label('Sent Date'),

                DatePicker::make('approved_at')
                    ->label('Approved Date'),

                DatePicker::make('rejected_at')
                    ->label('Rejected Date'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Quote $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Quote $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->searchable()
                    ->sortable(),

                // TextColumn::make('identification'),

                // TextColumn::make('subtotal'),
                //
                // TextColumn::make('discount'),

                // TextColumn::make('percentage_utilidad'),
                //
                // TextColumn::make('percentage_administracion'),
                //
                // TextColumn::make('percentage_inprevistos'),
                //
                // TextColumn::make('percentage_retefuente'),

                TextColumn::make('valid_until')
                    ->date(),

                // TextColumn::make('sent_at')
                //     ->label('Sent Date')
                //     ->date(),
                //
                // TextColumn::make('approved_at')
                //     ->label('Approved Date')
                //     ->date(),
                //
                // TextColumn::make('rejected_at')
                //     ->label('Rejected Date')
                //     ->date(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),

                Action::make('Descargar')
                    // ->icon('heroicon-o-download')
                    ->form([
                        Checkbox::make('show_values')
                            ->label('Mostrar Valores')
                            ->default(true),

                        Checkbox::make('show_summary')
                            ->label('Mostrar Resumen')
                            ->default(true),

                        Checkbox::make('inline_values')
                            ->label('Valor en línea')
                            ->default(true),

                        Checkbox::make('center_text')
                            ->label('Texto Centrado')
                            ->default(false),

                        Checkbox::make('break_on_tables')
                            ->label('Saltar en cada tabla')
                            ->default(false),
                    ])
                    // ->url(fn(array $data, $record): string => route('export-quote', $record->id, $data))
                    // ->url
                    // ->action(function (array $data, $record): string {
                    ->action(function (array $data, $record) {
                        $data['quote_id'] = $record->id;

                        return redirect()->route('export-quote', $data);
                    })
                    // ->modalContent(fn ($record): View => view(
                    //     'filament.pages.actions.advance',
                    //     ['record' => $record],
                    // )),
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
            'index' => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuote::route('/create'),
            'edit' => Pages\EditQuote::route('/{record}/edit'),
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
        return parent::getGlobalSearchEloquentQuery()->with(['project']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['project.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->project) {
            $details['Project'] = $record->project->name;
        }

        return $details;
    }
}
