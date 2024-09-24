<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Slide\getSlide;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;

class ApiSlideController extends Controller
{
    private $getSlide;

    public function __construct(
        getSlide $getSlide,
    ){
        $this->middleware('auth:api');
        $this->getSlide = $getSlide;
    }

    public function getAll()
    {
        try {
            $slide = $this->getSlide->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($slide, 'slide get successfully');

    }
}
