<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Video\getLinkMusic;
use App\Services\Video\getTestImage;
use App\Services\Video\getVideo;
use App\Services\Video\getVideoTest;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;

class ApiVideoController extends Controller
{
    private $getVideo;
    private $getVideoTest;
    private $getTestImage;
    private $getLinkMusic;

    public function __construct(
        getVideo $getVideo,
        getVideoTest $getVideoTest,
        getTestImage $getTestImage,
        getLinkMusic $getLinkMusic,
    ){
        $this->middleware('auth:api');
        $this->getVideo = $getVideo;
        $this->getVideoTest = $getVideoTest;
        $this->getTestImage = $getTestImage;
        $this->getLinkMusic = $getLinkMusic;
    }

    public function getVideo()
    {
        try {
            $video = $this->getVideo->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($video, 'video get successful');
    }

    public function getVideoTest()
    {
        try {
            $video = $this->getVideoTest->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($video, 'video get successful');
    }

    public function getTestImage()
    {
        try {
            $video = $this->getTestImage->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($video, 'video get successful');
    }

    public function getLinkMusic()
    {
        try {
            $video = $this->getLinkMusic->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($video, 'video get successful');
    }
}
