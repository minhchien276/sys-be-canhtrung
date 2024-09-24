<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VietNamUnits\getDistricts;
use App\Services\VietNamUnits\getProvinces;
use App\Services\VietNamUnits\getWards;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;

class ApiVietNamUnitsController extends Controller
{
    private $getProvinces;
    private $getDistricts;
    private $getWards;

    public function __construct(
        getProvinces $getProvinces,
        getDistricts $getDistricts,
        getWards $getWards,
    ) {
        $this->middleware('auth:api');
        $this->getProvinces = $getProvinces;
        $this->getDistricts = $getDistricts;
        $this->getWards = $getWards;
    }

    public function getProvinces()
    {
        try {
            $provinces = $this->getProvinces->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($provinces, 'provinces get successful');
    }

    public function getDistricts($province_code)
    {
        try {
            $districts = $this->getDistricts->handle($province_code);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($districts, 'districts get successful');
    }

    public function getWards($district_code)
    {
        try {
            $wards = $this->getWards->handle($district_code);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($wards, 'wards get successful');
    }
}
