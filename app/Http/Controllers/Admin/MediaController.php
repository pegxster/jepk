<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $files  = [];
        $paths  = Storage::disk('public')->allFiles('images');

        foreach ($paths as $path) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                continue;
            }
            $files[] = [
                'path'     => $path,
                'url'      => asset('storage/' . $path),
                'name'     => basename($path),
                'size'     => Storage::disk('public')->size($path),
                'modified' => Storage::disk('public')->lastModified($path),
            ];
        }

        usort($files, fn($a, $b) => $b['modified'] - $a['modified']);

        return view('admin.media.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files'   => 'required',
            'files.*' => 'image|max:5120',
        ]);

        $uploaded = [];
        $folder   = $request->input('folder', 'images/uploads');

        foreach ($request->file('files') as $file) {
            $path      = $file->store($folder, 'public');
            $uploaded[] = [
                'path' => $path,
                'url'  => asset('storage/' . $path),
                'name' => basename($path),
            ];
        }

        return response()->json(['success' => true, 'files' => $uploaded]);
    }

    public function destroy(Request $request)
    {
        $path = $request->input('path');

        if (!$path || !Storage::disk('public')->exists($path)) {
            return response()->json(['success' => false, 'message' => 'Fichier introuvable.'], 404);
        }

        Storage::disk('public')->delete($path);

        return response()->json(['success' => true]);
    }
}
