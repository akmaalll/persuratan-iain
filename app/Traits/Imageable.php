<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Imageable
{
    /**
     * Undocumented function
     *
     * @param string $filename
     * @param string|null $path
     * @param string|null $disk
     * @return string|boolean
     */
    public function fullImageUrl($filename, $path = null, $disk = 'public')
    {
        if ($filename) {
            $storage = Storage::disk($disk);
            $filepath = ($path != null ? $path . '/' : null) . $filename;

            if ($storage->exists($filepath)) {
                return $storage->url($filepath);
            }
        }
        return null;
    }
}
