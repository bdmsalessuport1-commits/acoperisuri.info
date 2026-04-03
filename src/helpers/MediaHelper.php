<?php

namespace App\Helpers;

class MediaHelper
{
    /** Zone presets: [width, height, maxKB, label] */
    public const ZONES = [
        'hero'      => ['w' => 1920, 'h' => 900,  'max_kb' => 500, 'label' => 'Hero / Slider',         'hint' => '1920x900px, JPG/WebP, max 500KB'],
        'category'  => ['w' => 800,  'h' => 800,  'max_kb' => 300, 'label' => 'Card categorie',         'hint' => '800x800px, PNG/WebP, patrat'],
        'product'   => ['w' => 1400, 'h' => 1000, 'max_kb' => 400, 'label' => 'Imagine produs',         'hint' => '1400x1000px, WebP/JPG'],
        'thumbnail' => ['w' => 400,  'h' => 300,  'max_kb' => 100, 'label' => 'Thumbnail (auto)',        'hint' => '400x300px, auto-generat'],
        'blog'      => ['w' => 1200, 'h' => 630,  'max_kb' => 400, 'label' => 'Blog featured',           'hint' => '1200x630px, JPG/WebP'],
        'logo'      => ['w' => 300,  'h' => 150,  'max_kb' => 100, 'label' => 'Logo producator',         'hint' => '300x150px, PNG transparent'],
        'swatch'    => ['w' => 200,  'h' => 200,  'max_kb' => 80,  'label' => 'Culoare / Swatch produs', 'hint' => '200x200px, JPG/WebP, patrat, fundal curat'],
        'general'   => ['w' => 1200, 'h' => 1200, 'max_kb' => 500, 'label' => 'General',                 'hint' => 'Max 1200x1200px, orice format'],
    ];

    private const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    private const MAX_UPLOAD_SIZE = 10 * 1024 * 1024; // 10MB raw upload limit

    /**
     * Process an uploaded file: validate, resize, convert to WebP, generate thumbnail
     * Returns array with file info or null on error
     */
    public static function processUpload(array $file, string $zone = 'general'): ?array
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        if ($file['size'] > self::MAX_UPLOAD_SIZE) {
            return null;
        }

        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, self::ALLOWED_TYPES, true)) {
            return null;
        }

        $zoneConfig = self::ZONES[$zone] ?? self::ZONES['general'];
        $targetW = $zoneConfig['w'];
        $targetH = $zoneConfig['h'];

        // Generate unique filename
        $ext = 'webp';
        $baseName = pathinfo($file['name'], PATHINFO_FILENAME);
        $baseName = preg_replace('/[^a-z0-9\-]/', '-', mb_strtolower($baseName));
        $baseName = preg_replace('/-+/', '-', trim($baseName, '-'));
        $timestamp = date('Ymd-His');
        $uniqueName = $baseName . '-' . $timestamp;

        $uploadDir = ROOT_PATH . '/public/uploads/';
        $thumbDir = ROOT_PATH . '/public/uploads/thumbs/';

        if (!is_dir($thumbDir)) {
            mkdir($thumbDir, 0755, true);
        }

        // Load source image
        $src = self::loadImage($file['tmp_name'], $mime);
        if (!$src) {
            return null;
        }

        $origW = imagesx($src);
        $origH = imagesy($src);

        // Resize to fit zone dimensions (maintain aspect ratio)
        $resized = self::resizeToFit($src, $targetW, $targetH);

        // Save as WebP (main)
        $mainFile = $uniqueName . '.' . $ext;
        $mainPath = $uploadDir . $mainFile;
        $quality = 85;
        imagewebp($resized, $mainPath, $quality);

        // Check file size, reduce quality if needed
        $maxBytes = $zoneConfig['max_kb'] * 1024;
        while (filesize($mainPath) > $maxBytes && $quality > 40) {
            $quality -= 10;
            imagewebp($resized, $mainPath, $quality);
        }

        // Generate thumbnail (400x300)
        $thumbConfig = self::ZONES['thumbnail'];
        $thumb = self::resizeToFit($src, $thumbConfig['w'], $thumbConfig['h']);
        $thumbFile = $uniqueName . '-thumb.' . $ext;
        $thumbPath = $thumbDir . $thumbFile;
        imagewebp($thumb, $thumbPath, 80);

        // Also save original format as fallback for logos (PNG transparency)
        $pngFallback = '';
        if ($zone === 'logo' && $mime === 'image/png') {
            $pngFile = $uniqueName . '.png';
            $pngResized = self::resizeToFit($src, $targetW, $targetH);
            imagesavealpha($pngResized, true);
            imagepng($pngResized, $uploadDir . $pngFile, 8);
            imagedestroy($pngResized);
            $pngFallback = '/uploads/' . $pngFile;
        }

        $finalW = imagesx($resized);
        $finalH = imagesy($resized);

        imagedestroy($src);
        imagedestroy($resized);
        imagedestroy($thumb);

        return [
            'filename'      => $mainFile,
            'original_name' => $file['name'],
            'url'           => '/uploads/' . $mainFile,
            'thumb_url'     => '/uploads/thumbs/' . $thumbFile,
            'png_fallback'  => $pngFallback,
            'mime'          => 'image/webp',
            'size'          => filesize($mainPath),
            'width'         => $finalW,
            'height'        => $finalH,
            'zone'          => $zone,
        ];
    }

    private static function loadImage(string $path, string $mime): ?\GdImage
    {
        return match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($path) ?: null,
            'image/png'  => self::loadPng($path),
            'image/webp' => imagecreatefromwebp($path) ?: null,
            'image/gif'  => imagecreatefromgif($path) ?: null,
            default      => null,
        };
    }

    private static function loadPng(string $path): ?\GdImage
    {
        $img = imagecreatefrompng($path);
        if (!$img) return null;
        imagesavealpha($img, true);
        imagealphablending($img, true);
        return $img;
    }

    /**
     * Resize image to fit within maxW x maxH, maintaining aspect ratio
     */
    private static function resizeToFit(\GdImage $src, int $maxW, int $maxH): \GdImage
    {
        $origW = imagesx($src);
        $origH = imagesy($src);

        if ($origW <= $maxW && $origH <= $maxH) {
            // No resize needed, just copy
            $dst = imagecreatetruecolor($origW, $origH);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            imagecopy($dst, $src, 0, 0, 0, 0, $origW, $origH);
            return $dst;
        }

        $ratioW = $maxW / $origW;
        $ratioH = $maxH / $origH;
        $ratio = min($ratioW, $ratioH);

        $newW = (int) round($origW * $ratio);
        $newH = (int) round($origH * $ratio);

        $dst = imagecreatetruecolor($newW, $newH);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);

        return $dst;
    }

    /**
     * Delete media files from disk
     */
    public static function deleteFiles(array $mediaItem): void
    {
        $uploadDir = ROOT_PATH . '/public';

        $url = $mediaItem['url'] ?? '';
        if ($url && file_exists($uploadDir . $url)) {
            unlink($uploadDir . $url);
        }

        $thumbUrl = $mediaItem['thumb_url'] ?? '';
        if ($thumbUrl && file_exists($uploadDir . $thumbUrl)) {
            unlink($uploadDir . $thumbUrl);
        }

        $pngFallback = $mediaItem['png_fallback'] ?? '';
        if ($pngFallback && file_exists($uploadDir . $pngFallback)) {
            unlink($uploadDir . $pngFallback);
        }
    }
}
