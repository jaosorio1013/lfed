<?php

namespace App\Filament\Resources\LFED\ProjectResource\RelationManagers;

use App\Models\Project;
use App\Models\Quote;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
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

class QuotesRelationManager extends RelationManager
{
    protected static string $relationship = 'quotes';

    // protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select::make('project_id')
                //     ->relationship('project', 'name')
                //     ->searchable()
                //     ->required(),

                // TextInput::make('identification')
                //     ->required(),

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

    public function table(Table $table): Table
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
            ->headerActions([
                CreateAction::make()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}