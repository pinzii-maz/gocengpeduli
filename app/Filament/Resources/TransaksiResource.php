<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Mail\NotaMail;
use Filament\Forms\Form;
use App\Models\Transaksi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TransaksiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransaksiResource\RelationManagers;


class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   public static function getEloquentQuery(): Builder
   {
    return parent::getEloquentQuery()->where('status', 'success');
   }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
    TextColumn::make('donasi.title')
        ->label('Judul Donasi')
        ->searchable()
        ->sortable(),

    TextColumn::make('donor_name')
        ->label('Nama Donatur'),

    TextColumn::make('donor_email')
        ->label('Email Donatur'),

    TextColumn::make('amount')
        ->label('Jumlah Donasi')
        ->money('IDR', true), // styling rupiah

    TextColumn::make('created_at')
        ->label('Tanggal Donasi')
        ->dateTime('d M Y - H:i')
])

            ->filters([
                //
            ])
            ->actions([
                Action::make('send_email')
                    ->label('Kirim Email')
                    ->icon('heroicon-o-envelope')
                    ->form([
                        Textarea::make('pesan')
                            ->label('Pesan')
                            ->required(),
                        FileUpload::make('lampiran')
                            ->label('Lampiran PDF')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('nota-attachments')
                            ->multiple(false)
                            ->maxFiles(1),
                    ])
                    ->action(function (Transaksi $record, array $data) {
                        $attachmentPath = $data['lampiran'] ?? null;
                        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            
                        try {
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = env('MAIL_USERNAME'); 
                            $mail->Password = env('MAIL_PASSWORD');
                            $mail->SMTPSecure = 'tls';
                            $mail->Port = 587;
            
                            $mail->Username = env('MAIL_USERNAME');
                            $mail->Password = env('MAIL_PASSWORD'); 
                            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); 
                            $mail->addAddress($record->donor_email);
            
                            if (!empty($attachmentPath)) {
                                $mail->addAttachment(storage_path('app/public/' . $attachmentPath), 'Nota_Penggunaan.pdf');
                            }
            
                            $mail->isHTML(true);
                            $mail->Subject = 'Nota Penggunaan Dana Donasi';
                            $mail->Body    = nl2br(e($data['pesan']));
                            $mail->AltBody = strip_tags($data['pesan']);
            
                            $mail->send();
                        } catch (\PHPMailer\PHPMailer\Exception $e) {
                            throw new \Exception('Email gagal dikirim. Error: ' . $mail->ErrorInfo);
                        }
                    }),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
