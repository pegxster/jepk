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
 * Resolve a product image path/URL to a full displayable URL.
 * Handles: relative paths (assets/, uploads/), full URLs, null/empty values.
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
