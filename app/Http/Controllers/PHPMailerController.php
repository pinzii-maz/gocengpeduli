<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PHPMailerController extends Controller
{
    public function kirimNota(Request $request)
    {
        $pesan = $request->input('pesan', 'Terima kasih atas donasi Anda.');
        $emailTujuan = $request->input('email');

        if (empty($emailTujuan) || !filter_var($emailTujuan, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Alamat email penerima tidak valid!'], 400);
        }
        // Path ke file lampiran PDF
        $filePath = storage_path('app/nota-attachments/nota.pdf'); // contoh

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Lampiran tidak ditemukan!'], 404);
        }

        $mail = new PHPMailer(true);

        try {
            // Konfigurasi SMTP Mailtrap
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ganti ke Gmail kalau perlu
            $mail->SMTPAuth = true;
            $mail->Username = 'MAIL_USERNAME'; // Ganti
            $mail->Password = 'MAIL_PASSWORD'; // Ganti
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Pengirim & penerima
            $mail->setFrom('admin@webdonasi.com', 'Admin Donasi');
            $mail->addAddress($emailTujuan);

            // Lampiran
            $mail->addAttachment($filePath, 'Nota_Penggunaan.pdf');

            // Isi email
            $mail->isHTML(true);
            $mail->Subject = 'Nota Penggunaan Dana Donasi';
            $mail->Body = nl2br(e($pesan));

            // Kirim
            $mail->send();

            return response()->json(['message' => 'Email berhasil dikirim!']);
        } catch (Exception $e) {
            return response()->json(['error' => $mail->ErrorInfo], 500);
        }
    }
}
