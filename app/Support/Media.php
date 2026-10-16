<?php

namespace App\Support;

class Media
{
    /**
     * Resolve a stored path, absolute URL, or null to a usable image URL.
     */
    public static function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/') || str_starts_with($path, '/assets/')) {
            return asset(ltrim($path, '/'));
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}
