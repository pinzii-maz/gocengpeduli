<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

use Filament\Forms;
use Filament\Tables;
use App\Models\Donasi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\DonasiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DonasiResource\RelationManagers;

class DonasiResource extends Resource
{
    protected static ?string $model = Donasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift'; // Ikon diganti agar lebih sesuai
    protected static ?string $navigationLabel = 'Program Donasi';
    protected static ?string $navigationGroup = 'Manajemen Donasi'; // Grup menu
    protected static ?int $navigationSort = 1; // Urutan menu
    protected static ?string $slug = 'program-donasi';
    public static ?string $label = 'Program Donasi';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Informasi Utama')
                            ->schema([
                                FileUpload::make('image')->label('Gambar Donasi')->required()->directory('donasi')->image()->columnSpanFull(),
                                TextInput::make('title')->label('Judul Donasi')->required()->maxLength(255),
                                Select::make('category_id')->relationship('category', 'name')->searchable()->preload()->required()->label('Kategori Donasi'),
                                MarkdownEditor::make('description')->label('Deskripsi Donasi')->required()->columnSpanFull(),
                                DateTimePicker::make('deadline')->label('Deadline Donasi')->required(),
                                TextInput::make('target_amount')->numeric()->label('Target Donasi')->prefix('Rp '),
                            ]),
                        
                        Tabs\Tab::make('Laporan Akhir')
                            ->schema([
                                FileUpload::make('report_document')
                                    ->label('Dokumen Laporan (PDF)')
                                    ->directory('reports')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->helperText('Upload laporan akhir dalam format PDF jika donasi sudah selesai.'),
                            ])
                            // Sembunyikan tab ini saat membuat donasi baru
                            ->hidden(fn (string $operation): bool => $operation === 'create'),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Gambar'),
                TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                
                // --- KOLOM BARU UNTUK STATUS -- -
                TextColumn::make('deadline')
                ->label('Status')
                ->badge()
                ->formatStateUsing(fn ($record): string => $record->deadline > now() ? 'Berjalan' : 'Selesai')
                ->color(fn (string $state): string => match ($state) {
                    'Berjalan' => 'success',
                    'Selesai' => 'danger',
                })
                ->sortable(),
                
                TextColumn::make('category.name')->label('Kategori')->sortable(),
                
                TextColumn::make('total_terkumpul')
                    ->label('Terkumpul')
                    ->money('IDR'), // Cara lebih singkat untuk format Rupiah

                TextColumn::make('target_amount')
                    ->label('Target')
                    ->money('IDR'),
                
                TextColumn::make('jumlah_donatur')->label('Donatur')->sortable(),

                TextColumn::make('deadline')
                    ->label('Deadline')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                // --- FILTER BARU ---
                Filter::make('berjalan')
                    ->label('Status: Berjalan')
                    ->query(fn (Builder $query): Builder => $query->where('deadline', '>', now())),

                Filter::make('selesai')
                    ->label('Status: Selesai')
                    ->query(fn (Builder $query): Builder => $query->where('deadline', '<=', now())),
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

    // --- QUERY SUDAH DIOPTIMALKAN ---
    public static function getEloquentQuery(): Builder
    {
        // Eager load HANYA relasi yang kita butuhkan untuk perhitungan (accessor)
        return parent::getEloquentQuery()
            ->with('successfulTransactions');
    }
    
    // ... (sisa method tidak perlu diubah)
}