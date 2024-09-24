<?php

namespace App\Helpers;

class QrCodeHelper
{
    public static function maskQrCode($qrCode)
    {
        return substr_replace($qrCode, '*****', 0, 5);
    }
}
