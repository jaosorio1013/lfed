<?php

namespace App\Filament\Resources\LFED\PersonResource\RelationManagers;

use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
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

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select::make('client_id')
                //     ->relationship('client', 'name')
                //     ->searchable()
                //     ->required(),

                TextInput::make('name')
                    ->required(),

                RichEditor::make('description')
                    ->columnSpanFull(),

                // DatePicker::make('won_at')
                //     ->label('Won Date'),
                //
                // DatePicker::make('lost_at')
                //     ->label('Lost Date'),
                //
                // DatePicker::make('started_at')
                //     ->label('Started Date'),
                //
                // DatePicker::make('finished_at')
                //     ->label('Finished Date'),
                //
                // Placeholder::make('created_at')
                //     ->label('Created Date')
                //     ->content(fn(?Project $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                //
                // Placeholder::make('updated_at')
                //     ->label('Last Modified Date')
                //     ->content(fn(?Project $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                // TextColumn::make('won_at')
                //     ->label('Won Date')
                //     ->date(),
                //
                // TextColumn::make('lost_at')
                //     ->label('Lost Date')
                //     ->date(),
                //
                // TextColumn::make('started_at')
                //     ->label('Started Date')
                //     ->date(),
                //
                // TextColumn::make('finished_at')
                //     ->label('Finished Date')
                //     ->date(),
                //
                // TextColumn::make('client.name')
                //     ->searchable()
                //     ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make(),
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
}