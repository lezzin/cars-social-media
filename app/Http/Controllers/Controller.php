<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class Controller
{
    protected function handleFileUpload(?UploadedFile $file, string $directory, ?string $oldPath = null): ?string
    {
        if (! $file) {
            return $oldPath;
        }

        if ($oldPath && Storage::exists($oldPath)) {
            Storage::delete($oldPath);
        }

        return $file->store($directory);
    }
}
