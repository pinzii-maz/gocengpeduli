<?php

namespace App\Observers;

use Illuminate\Support\Facades\Log;
use App\Models\Donasi;
use App\Models\Transaksi;

class TransaksiObserver
{
    /**
     * Handle the Transaksi "created" event.
     */
    public function created(Transaksi $transaksi): void
    {
        Log::info("Transaksi created: " . $transaksi->id); 
    if ($transaksi->status === 'success') {    
        Log::info("Memproses transaksi sukses untuk donasi: " . $transaksi->donation_id);    
        $transaksi->donation->updateStats();
    }
    }

    /**
     * Handle the Transaksi "updated" event.
     */
    public function updated(Transaksi $transaksi): void
    {

          // Jika ada perubahan status atau amount, update stats
          if ($transaksi->isDirty('status') || $transaksi->isDirty('amount')) {
            $transaksi->donation->updateStats();
        }
    }


    /**
     * Handle the Transaksi "deleted" event.
     */
    public function deleted(Transaksi $transaksi): void
    {
        if ($transaksi->donation) {
            $transaksi->donation->updateStats();
        }
    }

    /**
     * Handle the Transaksi "restored" event.
     */
    public function restored(Transaksi $transaksi): void
    {
        //
    }

    /**
     * Handle the Transaksi "force deleted" event.
     */
    public function forceDeleted(Transaksi $transaksi): void
    {
        //
    }
}
