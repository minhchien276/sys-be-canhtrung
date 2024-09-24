<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaiLieuKichSua\getImage;
use App\Services\TaiLieuKichSua\getVideo;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;

class TaiLieuKichSuaController extends Controller
{
    private $getImage;
    private $getVideo;

    public function __construct(
        getImage $getImage,
        getVideo $getVideo,
    ) {
        $this->getImage = $getImage;
        $this->getVideo = $getVideo;
    }

    public function getImage()
    {
        try {
            $data = $this->getImage->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($data, 'Danh sach tai lieu');
    }

    public function getVideo()
    {
        try {
            $data = $this->getVideo->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($data, 'Danh sach tai lieu');
    }
}
