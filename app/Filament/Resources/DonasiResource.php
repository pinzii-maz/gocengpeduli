<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Donasi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\FormsComponent;
use Forms\Components\NumericInput;
use Forms\Components\DateTimePicker;
use Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DonasiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DonasiResource\RelationManagers;

class DonasiResource extends Resource
{
    protected static ?string $model = Donasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Donasi';
    protected static ?string $slug = 'Donasi';
    public static ?string $label = 'kelola Donasi';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Gambar Donasi')
                    ->required()
                    ->directory('donasi')
                    ->image()
                    ->columnSpan(2),
                    
                    Forms\Components\TextInput::make('title')
                    ->label('Judul Donasi')
                    ->required()
                    ->maxLength(255),
                    
                    Forms\Components\TextInput::make('category')
                    ->label('Kategori Donasi')
                    ->required()
                    ->maxLength(255),
                    
                    Forms\Components\MarkdownEditor::make('description')
                    ->label('Deskripsi Donasi')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                    Forms\Components\DateTimePicker::make('deadline')
                    ->label('Deadline Donasi')
                    ->required()
                    ->default(now()->addDays(7))
                    ->minDate(now()),

                    Forms\Components\TextInput::make('target_amount')
                    ->numeric()
                    ->label('target donasi')
                    ->minValue(0)
                    ->default(0)
                    ->maxValue(10000000)
                    ->prefix('Rp '),

                    Forms\Components\TextInput::make('current_amount')
                    ->label('Jumlah Donasi')
                    ->numeric()
                    ->default(0)
                    ->disabled()
                    ->prefix('Rp ')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'), //udah
                Tables\Columns\TextColumn::make('title'), //udah
                Tables\Columns\TextColumn::make('category'), //udah
                Tables\Columns\TextColumn::make('description'), //udah
                Tables\Columns\TextColumn::make('target_amount'), //https://github.com/aimanyusufw/laravel-dashboard-ecommerce.gitudah
                Tables\Columns\TextColumn::make('deadline_label')
                    ->label('Status Deadline')
                    ->description(fn ($record) => $record->deadline?->format('d M Y')),

                Tables\Columns\TextColumn::make('total_terkumpul')
                    ->label('Terkumpul')
                    ->state(fn ($record) => $record->total_terkumpul)
                    ->formatStateUsing(fn ($state) => \App\Helpers\FormatHelpers::rupiah($state)),

                Tables\Columns\TextColumn::make('target_amount')
                    ->label('Target')
                    ->formatStateUsing(fn ($state) => \App\Helpers\FormatHelpers::rupiah($state)),

                Tables\Columns\TextColumn::make('persentase')
                    ->label('Persentase')
                    ->suffix('%'),

                Tables\Columns\TextColumn::make('jumlah_donatur')
                    ->label('Donatur'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonasis::route('/'),
            'create' => Pages\CreateDonasi::route('/create'),
            'edit' => Pages\EditDonasi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->with('transaksis'); // penting: eager load relasi
}

public static function getRedirectUrlAfterCreate(): string
{
    return static::getUrl(); // Redirect ke tabel setelah buat baru
}

public static function getRedirectUrlAfterEdit(): string
{
    return static::getUrl(); 
}

}
