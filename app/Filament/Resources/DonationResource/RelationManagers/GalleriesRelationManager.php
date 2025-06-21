<?php

namespace App\Filament\Resources\DonationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class GalleriesRelationManager extends RelationManager
{
    protected static string $relationship = 'galleries';
    protected static ?string $title = 'Foto Dokumentasi Laporan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->label('Foto Dokumentasi')
                    ->required()->image()->directory('galleries/reports')->columnSpanFull(),
                TextInput::make('title')
                    ->label('Judul Foto (Caption)')
                    ->required()->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                // Tables\Columns\TextColumn::make('title'),
                ImageColumn::make('image')->width(80)->height(80),
                TextColumn::make('title')->label('Caption'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
