<?php

namespace App\Http\Controllers;

use App\Models\PhotoSession;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CameraController extends Controller
{
    public function index()
    {
        return view('camera');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'template' => 'required|string',
            'photos' => 'required|string', // JSON array of base64
            'final_strip' => 'nullable|string'
        ]);

        $photosData = json_decode($request->photos, true);
        if (!$photosData || count($photosData) == 0) {
            return back()->withErrors('No photos captured.');
        }

        $sessionCode = strtoupper(Str::random(8));
        
        $template = \App\Models\Template::firstOrCreate(
            ['id' => 1],
            ['name' => 'Default 4-Cut', 'file_path' => 'default.png', 'frame_count' => 4, 'is_active' => true]
        );

        $session = PhotoSession::create([
            'template_id' => $template->id,
            'session_code' => $sessionCode,
            'status' => 'completed'
        ]);

        $savedPhotos = [];
        foreach ($photosData as $index => $base64) {
            $imgData = substr($base64, strpos($base64, ',') + 1);
            $imgData = base64_decode($imgData);
            
            $filename = $sessionCode . '_' . time() . '_' . $index . '.jpg';
            $path = 'photos/' . $sessionCode . '/' . $filename;
            
            Storage::disk('public')->put($path, $imgData);
            
            $savedPhotos[] = 'storage/' . $path;
            
            Photo::create([
                'photo_session_id' => $session->id,
                'file_path' => $path,
                'photo_url' => 'storage/' . $path,
                'is_final' => false
            ]);
        }
        
        if ($request->final_strip) {
            $stripData = substr($request->final_strip, strpos($request->final_strip, ',') + 1);
            $stripData = base64_decode($stripData);
            
            $stripFilename = $sessionCode . '_final.jpg';
            $stripPath = 'photos/' . $sessionCode . '/' . $stripFilename;
            
            \Illuminate\Support\Facades\Storage::disk('public')->put($stripPath, $stripData);
            
            Photo::create([
                'photo_session_id' => $session->id,
                'file_path' => $stripPath,
                'photo_url' => 'storage/' . $stripPath,
                'is_final' => true
            ]);
        }

        return redirect()->route('result', ['session_code' => $sessionCode]);
    }

    public function result($session_code)
    {
        $session = PhotoSession::where('session_code', $session_code)->with('photos')->firstOrFail();
        
        return view('result', compact('session'));
    }

    public function download($session_code)
    {
        $session = PhotoSession::where('session_code', $session_code)->with('photos')->firstOrFail();
        
        // In reality, this would download the finalized strip.
        // We'll just provide the first photo or zip for now.
        if ($session->photos->count() > 0) {
            $photo = $session->photos()->where('is_final', true)->first() ?? $session->photos->first();
            $path = storage_path('app/public/' . $photo->file_path);
            if (file_exists($path)) {
                return response()->download($path);
            } else {
                return back()->withErrors('File not found. Please ensure it was uploaded properly.');
            }
        }
        
        return back();
    }
}
