<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Plugin;

class UploadPlugin
{
    public function aroundCheckMimeType($subject, \Closure $proceed, $validTypes = [])
    {
        $allowedMimeTypesFme = [
            'image/jpg',
            'image/jpeg',
            'image/gif',
            'image/png',
            'application/pdf',
            'video/mp4'
        ];

        return $proceed($allowedMimeTypesFme);
    }
}
