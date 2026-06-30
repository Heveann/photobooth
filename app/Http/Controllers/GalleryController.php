<?php

namespace App\Http\Controllers;

use App\Models\PhotoSession;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $sessions = PhotoSession::with('photos')->latest()->take(20)->get();
        return view('gallery', compact('sessions'));
    }
}
