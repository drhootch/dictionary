<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntryResource\Pages;
use App\Filament\Resources\EntryResource\RelationManagers;
use App\Models\Entry;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class EntryResource extends Resource
{
    protected static ?string $model = Entry::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('Discovered contexts');
    }

    public static function getLabel(): string
    {
        return __('Discovered context');
    }

    public static function getPluralLabel(): string
    {
        return __('Discovered contexts');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('lemma')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('context_data.word')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make("context_data.context")
                    ->translateLabel()
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('context_hash', md5($state))),
                Forms\Components\Hidden::make("context_hash")
                    ->required(),
                KeyValue::make('context_data.meanings')
                    ->translateLabel()
                    ->columnSpanFull(),
                Repeater::make('context_data.ai.analysis')
                    ->translateLabel()
                    ->schema([
                        Forms\Components\TextInput::make("meaningNumber")
                            ->helperText(fn (Get $get, $state) => $get('../../../meanings')[$state - 1] ?? "")
                            ->translateLabel()
                            ->live(),
                        Forms\Components\TextInput::make("percentage")
                            ->translateLabel(),
                        Forms\Components\Textarea::make("explanation")
                            ->translateLabel(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('context_data.word')
                    ->label("Word")
                    ->translateLabel()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('context_data->word', 'like', "%{$search}%");
                    }),
                Tables\Columns\TextColumn::make('lemma')
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('meanings')
                    //reorder meanings
                    ->formatStateUsing(fn (array $state): string => (isset($state["percentage"]) ? ($state["percentage"] . "% . ") : "") . ($state["meaning"] ?? ""))
                    ->color(fn (array $state): string => ($state["accepted"] ?? false) ? "primary" : "black")
                    ->label("Meanings")
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->limitList(4)
                    ->translateLabel()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('context_data->meanings', 'like', "%{$search}%");
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEntries::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
