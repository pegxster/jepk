<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $files = Media::orderBy('created_at', 'desc')->get()->map(fn ($media) => [
            'path'     => 'media/' . $media->_id,
            'url'      => route('media.show', $media->_id),
            'name'     => $media->filename,
            'size'     => $media->size,
            'modified' => $media->created_at?->timestamp,
        ])->toArray();

        return view('admin.media.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files'   => 'required',
            'files.*' => 'image|max:5120',
        ]);

        $uploaded = [];

        foreach ($request->file('files') as $file) {
            $ref = store_image_in_db($file, 'uploads');
            $id  = substr($ref, strlen('media/'));

            $uploaded[] = [
                'path' => $ref,
                'url'  => route('media.show', $id),
                'name' => $file->getClientOriginalName(),
            ];
        }

        return response()->json(['success' => true, 'files' => $uploaded]);
    }

    public function destroy(Request $request)
    {
        $path = $request->input('path');

        if (!$path || !str_starts_with($path, 'media/')) {
            return response()->json(['success' => false, 'message' => 'Fichier introuvable.'], 404);
        }

        delete_image_from_db($path);

        return response()->json(['success' => true]);
    }
}
