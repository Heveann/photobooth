<?php

namespace App\Http\Controllers;

use App\Models\PhotoSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $sessions = PhotoSession::with('photos')->latest()->take(20)->get();
        return view('gallery', compact('sessions'));
    }

    public function destroy($id)
    {
        $session = PhotoSession::with('photos')->findOrFail($id);
        
        // Delete folder from storage if it exists
        $folderPath = 'photos/' . $session->session_code;
        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }
        
        // Delete records from database
        $session->photos()->delete();
        $session->delete();
        
        return redirect()->route('gallery')->with('success', 'Photo successfully deleted.');
    }
}
