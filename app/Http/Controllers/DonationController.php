<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Gallery;

class DonationController extends Controller
{
    public function index()
    {
        
        $donasi = \App\Models\donasi::with('successfulTransactions') 
                        ->where('deadline', '>', now()) 
                        ->latest()
                        ->get();

        $galleries = Gallery::latest()->get(); 

     return view('home', compact('donasi', 'galleries'));
    }

}
