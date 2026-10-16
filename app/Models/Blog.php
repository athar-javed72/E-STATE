<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'views',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    /**
     * Sanitize stored HTML for safe public rendering (allowlisted tags only).
     */
    public function safeContent(): string
    {
        $allowed = '<p><br><br/><strong><b><em><i><u><ul><ol><li><a><h2><h3><h4><h5><blockquote><img><span><div>';
        $html = strip_tags((string) $this->content, $allowed);

        // Strip inline event handlers (onclick, onerror, etc.)
        $html = preg_replace('/\son\w+\s*=\s*(["\']).*?\1/iu', '', $html) ?? $html;
        $html = preg_replace('/\son\w+\s*=\s*[^\s>]+/iu', '', $html) ?? $html;

        // Block javascript: / data: URLs in href/src
        $html = preg_replace(
            '/(href|src)\s*=\s*(["\'])\s*(javascript|data)\s*:[^"\']*\2/iu',
            '$1=$2#$2',
            $html
        ) ?? $html;

        return $html;
    }
}
