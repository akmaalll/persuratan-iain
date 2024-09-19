<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait NameSpaceFixer
{
    protected function getBaseDirectory($basePath, $factoryName)
    {
        return File::dirname($basePath . '\\' . $factoryName);
    }

    protected function getBaseFileName($basePath, $factoryName)
    {
        return File::basename($basePath . '\\' . $factoryName);
    }
}
