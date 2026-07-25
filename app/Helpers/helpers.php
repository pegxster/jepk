<?php

/**
 * Resolve a product image path/URL to a full displayable URL.
 * Handles: relative paths (assets/ or storage/), full URLs, null/empty values.
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

    // Already starts with assets/ — use asset() directly
    if (str_starts_with($image, 'assets/')) {
        return asset($image);
    }

    // Relative path → prepend storage URL
    return asset('storage/' . ltrim($image, '/'));
}
