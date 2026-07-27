<?php

/**
 * Get the base path for uploaded images (categories, products).
 * On Render with persistent disk → /var/data/uploads
 * Local dev → public_path('uploads')
 */
function uploads_disk_path(string $subdir = ''): string
{
    $base = env('IMAGES_DISK_PATH') ?: public_path('uploads');
    return $subdir ? $base . '/' . ltrim($subdir, '/') : $base;
}

/**
 * Get the URL prefix for uploaded images served via the uploads route.
 */
function uploads_url_prefix(): string
{
    return '/uploads';
}

/**
 * Save an uploaded file to the persistent uploads disk.
 * Returns the relative path to store in DB (e.g. "categories/cat-name-123.jpg").
 */
function save_uploaded_file($file, string $subdir): string
{
    $filename = $subdir . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();
    $destDir  = uploads_disk_path($subdir);

    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }

    $file->move($destDir, $filename);

    return $subdir . '/' . $filename;
}

/**
 * Delete an uploaded file from the persistent uploads disk.
 */
function delete_uploaded_file(string $relativePath): void
{
    $fullPath = uploads_disk_path($relativePath);
    if (file_exists($fullPath)) {
        @unlink($fullPath);
    }
}

/**
 * Enregistre un fichier uploadé directement dans MongoDB (collection "media").
 * Contrairement au disque local, ceci survit aux redéploiements sur un plan
 * Render gratuit (pas de disque persistant disponible).
 * Retourne une référence du type "media/{id}" à stocker sur le modèle.
 */
function store_image_in_db($file, string $folder = 'uploads'): string
{
    $filename = $folder . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();

    $media = \App\Models\Media::create([
        'filename'  => $filename,
        'mime_type' => $file->getMimeType(),
        'size'      => $file->getSize(),
        'data'      => base64_encode(file_get_contents($file->getRealPath())),
    ]);

    return 'media/' . $media->_id;
}

/**
 * Supprime une image stockée en base ("media/{id}"). Ignore silencieusement
 * les références qui ne pointent pas vers la médiathèque Mongo.
 */
function delete_image_from_db(string $ref): void
{
    if (!str_starts_with($ref, 'media/')) {
        return;
    }

    \App\Models\Media::where('_id', substr($ref, strlen('media/')))->delete();
}

/**
 * Resolve a product image path/URL to a full displayable URL.
 * Handles: relative paths (assets/, uploads/, media/), full URLs, null/empty values.
 */
function product_image_url(?string $image, string $fallback = ''): string
{
    if (empty($image)) {
        return $fallback ?: asset('assets/images/jepk4.jpg');
    }

    // Already a full URL
    if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
        return $image;
    }

    // Image stockée dans MongoDB (persiste entre les déploiements)
    if (str_starts_with($image, 'media/')) {
        return route('media.show', substr($image, strlen('media/')));
    }

    // Uploaded file via persistent disk (uploads/categories/... or uploads/products/...)
    if (str_starts_with($image, 'uploads/')) {
        return uploads_url_prefix() . '/' . ltrim($image, 'uploads/');
    }

    // Already starts with assets/ — use asset() directly
    if (str_starts_with($image, 'assets/')) {
        return asset($image);
    }

    // Legacy storage path → prepend storage URL
    return asset('storage/' . ltrim($image, '/'));
}
