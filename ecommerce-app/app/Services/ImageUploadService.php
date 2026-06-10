<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function store(?UploadedFile $file, ?string $url, string $folder): ?string
    {
        if ($file) {
            $path = $file->store($folder, 'public');

            return Storage::disk('public')->url($path);
        }

        return $url;
    }

    /**
     * @param  array<int, UploadedFile>  $files
     * @return array<int, string>
     */
    public function storeMany(array $files, string $folder): array
    {
        $urls = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $path = $file->store($folder, 'public');
                $urls[] = Storage::disk('public')->url($path);
            }
        }

        return $urls;
    }

    public function delete(?string $path): void
    {
        if (! $path || ! str_contains($path, '/storage/')) {
            return;
        }

        $relative = ltrim(str_replace('/storage/', '', parse_url($path, PHP_URL_PATH) ?? ''), '/');

        if ($relative) {
            Storage::disk('public')->delete($relative);
        }
    }
}
