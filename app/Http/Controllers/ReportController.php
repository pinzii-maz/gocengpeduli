<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\donasi;

class ReportController extends Controller
{
    public function index() {
         $completedDonations = donasi::with('successfulTransactions')
                                    ->where('deadline', '<=', now())
                                    ->latest('deadline')
                                    ->get();
        
        return view('reports.index', compact('completedDonations'));
    }

      public function show(donasi $donasi)
    {
        // Pastikan donasi yang diakses sudah selesai
        if ($donasi->deadline > now()) {
            abort(404); // Tampilkan halaman not found jika donasi belum selesai
        }
        
        // Load relasi donatur untuk item yang spesifik ini
        $donasi->load('successfulTransactions');

        // Kirim data ke view baru
        return view('reports.show', compact('donasi'));
    }
}
