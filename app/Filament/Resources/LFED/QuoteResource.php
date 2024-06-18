<?php

namespace App\Filament\Resources\LFED;

use App\Filament\Resources\LFED\QuoteResource\Pages;
use App\Models\Quote;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
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
                // Select::make('project_id')
                //     ->relationship('project', 'name')
                //     ->searchable()
                //     ->required(),
                //
                // TextInput::make('identification')
                //     ->required(),
                //
                // DatePicker::make('valid_until'),
                //
                // DatePicker::make('sent_at')
                //     ->label('Sent Date'),
                //
                // DatePicker::make('approved_at')
                //     ->label('Approved Date'),
                //
                // DatePicker::make('rejected_at')
                //     ->label('Rejected Date'),
                //
                // Placeholder::make('created_at')
                //     ->label('Created Date')
                //     ->content(fn(?Quote $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                //
                // Placeholder::make('updated_at')
                //     ->label('Last Modified Date')
                //     ->content(fn(?Quote $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                // Total
                Section::make('Totales')
                    ->columns(2)
                    ->schema([
                        Placeholder::make('subtotal')
                            ->content(fn(?Quote $record): string => '$ ' . number_format($record?->subtotal, 0, ',', '.')),

                        // TextInput::make('subtotal')
                        //     ->label('Subtotal')
                        //     ->numeric()
                        //     ->readOnly()
                        //     ->prefix('$'),

                        TextInput::make('discount')
                            ->label('Descuento')
                            ->numeric()
                            ->prefix('$'),

                        // Utilidad
                        TextInput::make('percentage_utilidad')
                            ->label('Porcentaje Utilidad')
                            ->suffix('%')
                            ->numeric(),

                        // TextInput::make('utilidad_value')
                        //     ->label('Valor Utilidad')
                        //     ->prefix('$')
                        //     ->readOnly()
                        //     ->numeric(),
                        Placeholder::make('utilidad_value')
                            ->label('Valor Utilidad')
                            ->content(fn(?Quote $record): string => '$ ' . number_format($record?->subtotal, 0, ',', '.')),

                        // Administración
                        TextInput::make('percentage_administracion')
                            ->label('Porcentaje Administracón')
                            ->suffix('%')
                            ->numeric(),

                        // TextInput::make('administracion_value')
                        //     ->label('Valor Administracón')
                        //     ->prefix('$')
                        //     ->readOnly()
                        //     ->numeric(),
                        Placeholder::make('administracion_value')
                            ->label('Valor Administracón')
                            ->content(fn(?Quote $record): string => '$ ' . number_format($record?->subtotal, 0, ',', '.')),

                        // Imprevistos
                        TextInput::make('percentage_imprevistos')
                            ->label('Porcentaje Imprevistos')
                            ->suffix('%')
                            ->numeric(),

                        // TextInput::make('imprevistos_value')
                        //     ->label('Valor Imprevistos')
                        //     ->prefix('$')
                        //     ->readOnly()
                        //     ->numeric(),
                        Placeholder::make('imprevistos_value')
                            ->label('Valor Imprevistos')
                            ->content(fn(?Quote $record): string => '$ ' . number_format($record?->subtotal, 0, ',', '.')),

                        // Retefuente
                        TextInput::make('percentage_retefuente')
                            ->label('Porcentaje Retefuente')
                            ->suffix('%')
                            ->numeric(),

                        // TextInput::make('retefuente_value')
                        //     ->label('Valor Retefuente')
                        //     ->prefix('$')
                        //     ->readOnly()
                        //     ->numeric(),
                        Placeholder::make('retefuente_value')
                            ->label('Valor Retefuente')
                            ->content(fn(?Quote $record): string => '$ ' . number_format($record?->subtotal, 0, ',', '.')),

                        // TextInput::make('subtotal')
                        //     ->numeric()
                        //     ->readOnly()
                        //     ->prefix('$')
                        // ->afterStateUpdated(function (Get $get, $livewire) {
                        //     self::updateTotals($get, $livewire);
                        // })
                        // ,
                        // Forms\Components\TextInput::make('taxes')
                        //     ->suffix('%')
                        //     ->required()
                        //     ->numeric()
                        //     ->default(20)
                        //     ->live(true)
                        //     ->afterStateUpdated(function (Get $get, $livewire) {
                        //         self::updateTotals($get, $livewire);
                        //     }),

                        TextInput::make('total')
                            ->numeric()
                            ->readOnly()
                            ->prefix('$')
                    ]),

                // Products List
                Section::make('Productos')
                    ->columns(1)
                    ->schema([
                        // Forms\Components\Repeater::make('quoteProducts')
                        //     ->relationship()
                        //     ->schema([
                        //         Forms\Components\Select::make('product_id')
                        //             ->relationship('product', 'name')
                        //             ->disableOptionWhen(function ($value, $state, Get $get) {
                        //                 return collect($get('../*.product_id'))
                        //                     ->reject(fn ($id) => $id == $state)
                        //                     ->filter()
                        //                     ->contains($value);
                        //             })
                        //             ->live()
                        //             ->afterStateUpdated(function (Get $get, Set $set, $livewire) {
                        //                 $set('price', Product::find($get('product_id'))->price);
                        //                 self::updateTotals($get, $livewire);
                        //             })
                        //             ->required(),
                        //         Forms\Components\TextInput::make('price')
                        //             ->required()
                        //             ->numeric()
                        //             ->live()
                        //             ->afterStateUpdated(function (Get $get, $livewire) {
                        //                 self::updateTotals($get, $livewire);
                        //             })
                        //             ->prefix('$'),
                        //         Forms\Components\TextInput::make('quantity')
                        //             ->integer()
                        //             ->default(1)
                        //             ->required()
                        //             ->live()
                        //     ])
                        //     ->live()
                        //     ->afterStateUpdated(function (Get $get, $livewire) {
                        //         self::updateTotals($get, $livewire);
                        //     })
                        //     ->afterStateHydrated(function (Get $get, $livewire) {
                        //         self::updateTotals($get, $livewire);
                        //     })
                        //     ->deleteAction(
                        //         fn (Action $action) => $action->after(fn (Get $get, $livewire) => self::updateTotals($get, $livewire)),
                        //     )
                        //     ->reorderable(false)
                        //     ->columns(3)
                    ]),
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
            ])
            ->recordUrl(function ($record) {
                return Pages\ViewQuote::getUrl([$record]);
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuote::route('/create'),
            'view' => Pages\ViewQuote::route('/{record}'),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ViewEntry::make('invoice')
                    ->columnSpanFull()
                    ->viewData([
                        'record' => $infolist->record
                    ])
                    ->view('infolists.components.quote-invoice-view')
            ]);
    }
}
