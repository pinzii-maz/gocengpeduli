<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Midtrans\Notification;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
        public function index(){
            return view('home');
        }

    public function checkout(Request $request){
        $orderId = 'TRX-' . time() . '-' . rand(100, 999);
        
        $transaksi = Transaksi::create([
        'order_id' => $orderId,
        'donation_id' => $request->donation_id,
        'donor_name' => $request->donor_name,
        'donor_email' => $request->donor_email,
        'amount' => $request->amount,
        'status' => 'pending',
    ]);


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        \Midtrans\Config::$overrideNotifUrl = config('app.url') . '/api/midtrans-callback';
        // dd(\Midtrans\Config::$overrideNotifUrl); 

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $transaksi->amount
            ),
            'customer_details' => array(
                'first_name' => $request->donor_name,
                'email' => $request->donor_email,
            ),
            'callbacks' => [
            'finish' => route('payment.succes') . "?order_id=" . $orderId,
            'unfinish' => route('payment.pending') . "?order_id=" . $orderId,
            'error' => route('payment.failed') . "?order_id=" . $orderId,
        ],
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaksi->snap_token = $snapToken;
        $transaksi->save();
        return view('checkout', compact('snapToken', 'transaksi'));
    }

    public function show($order_id)
    {
        // Cari transaksi berdasarkan order_id
        $transaksi = Transaksi::where('order_id', $order_id)->firstOrFail();

        // Tampilkan view detail dengan data transaksi
        return view('transaksi_detail', compact('transaksi'));
    }

    public function callback(Request $request)
    {
        try {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            $notification = new \Midtrans\Notification();
            
            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            
            Log::info("📥 Notifikasi Midtrans diterima untuk order_id: $orderId");
            
            $transaksi = Transaksi::where('order_id', $orderId)->first();

        if (!$transaksi) {
            Log::error("❌ Transaksi tidak ditemukan: $orderId");
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        if ($transaksi->status === 'success' || $transaksi->status === 'failed') {
            Log::info("🟡 Notifikasi untuk order_id: $orderId diabaikan karena status sudah final: {$transaksi->status}");
            return response()->json(['message' => 'Transaksi sudah memiliki status final.'], 200);
        }

        $newStatus = match (strtolower($transactionStatus)) {
            'capture', 'settlement' => ($fraudStatus === 'accept') ? 'success' : 'challenge',
            'pending' => 'pending',
            'deny', 'cancel', 'expire' => 'failed',
            default => $transaksi->status,
        };

        if ($transaksi->status !== $newStatus) {
            $transaksi->status = $newStatus;
            $transaksi->save();
            Log::info("🟢 Status untuk order_id: $orderId berhasil diperbarui menjadi: $newStatus");
            
            if ($newStatus === 'success') {
            }

        } else {
            Log::info("🟡 Status untuk order_id: $orderId tidak berubah: $newStatus");
        }

        return response()->json(['message' => 'Callback berhasil diproses'], 200);

    } catch (\Exception $e) {
        Log::error("💀 Error pada callback Midtrans: {$e->getMessage()}", [
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}
}
