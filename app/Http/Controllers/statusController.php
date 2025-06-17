<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;


class statusController extends Controller
{

    public function succes(Request $request)
    {
        $orderId = $request->query('order_id');
        $transaksi = Transaksi::where('order_id', $orderId)->firstOrFail();
        return view('succes', compact('transaksi'));
    }

    public function pending(Request $request)
    {
        $orderId = $request->query('order_id');
    // Alih-alih menampilkan view 'pending', kita REDIRECT ke rute detail
    return redirect()->route('transaksi.show', ['order_id' => $orderId]);
    }

    public function failed(Request $request)
    {
        $orderId = $request->query('order_id');
        $transaksi = Transaksi::where('order_id', $orderId)->firstOrFail();
        return view('failed', compact('transaksi'));
    }
}
