<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DonationController extends Controller
{
    public function index()
    {
        
        $donasi = \App\Models\donasi::with('successfulTransactions') 
                        ->where('deadline', '>', now()) 
                        ->latest()
                        ->get();

    return view('home', compact('donasi'));
    }

}
