<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WordResource\Pages;
use App\Filament\Resources\WordResource\RelationManagers;
use App\Models\Word;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WordResource extends Resource
{
    protected static ?string $model = Word::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('Entries');
    }

    public static function getLabel(): string
    {
        return __('Entry');
    }

    public static function getPluralLabel(): string
    {
        return __('Entries');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('lemma')->translatelabel(),
                Forms\Components\TextInput::make('stems')->translatelabel(),
                Forms\Components\TextInput::make('wordForms')->translatelabel(),
                Forms\Components\TextInput::make('senses')->translatelabel(),
                Forms\Components\TextInput::make('morphologicalPatterns')->translatelabel(),
                Forms\Components\TextInput::make('pos')->translatelabel(),
                Forms\Components\TextInput::make('plain')->translatelabel(),
                Forms\Components\TextInput::make('verbOrigin')->translatelabel(),
                Forms\Components\TextInput::make('nounOrigin')->translatelabel(),
                Forms\Components\TextInput::make('originality')->translatelabel(),
                Forms\Components\Checkbox::make('hasTanween')->translatelabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lemma')->translatelabel()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('stems')->translatelabel()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('wordForms')->translatelabel()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('senses')->translatelabel()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pos')->translatelabel()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('plain')->translatelabel()->searchable()->sortable(),


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
            'index' => Pages\ManageWords::route('/'),
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
