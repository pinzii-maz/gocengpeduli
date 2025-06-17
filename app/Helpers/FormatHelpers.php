<?php
namespace App\Helpers; // Sesuaikan dengan direktori

class FormatHelpers { // Nama class harus sama dengan nama file
    public static function rupiah($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
