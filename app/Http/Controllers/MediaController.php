<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Response;

class MediaController extends Controller
{
    public function show(string $id): Response
    {
        $media = Media::find($id);

        if (!$media) {
            abort(404);
        }

        return response(base64_decode($media->data), 200, [
            'Content-Type'  => $media->mime_type ?: 'application/octet-stream',
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }
}
