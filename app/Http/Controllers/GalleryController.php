<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;


class GalleryController extends Controller
{
    public function gallerypage() {
        $galleries = Gallery::latest()->get();
        return view('gallery', compact('galleries'));
    }
}
