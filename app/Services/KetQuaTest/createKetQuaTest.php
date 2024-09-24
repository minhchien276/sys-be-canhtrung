<?php

namespace App\Services\KetQuaTest;

use App\Enums\UrlImageS3Enum;
use App\Models\hoptest;
use App\Models\ketquatest;
use App\Models\quanlyquetest;
use App\Models\test_result;
use App\Services\AWSS3\uploadImage;
use App\Supports\Responder;
use Exception;

class createKetQuaTest
{
    private $upload_image;

    public function __construct(
        uploadImage $upload_image,
    ) {
        $this->upload_image = $upload_image;
    }

    public function handle($request)
    {
        $hoptestCount = hoptest::where('maNguoiDung', $request->maNguoiDung)->count();
        $qlqt = quanlyquetest::find($request->maQuanLyQueTest);

        if ($qlqt) {
            if ($request->maLoaiQue == 1) {
                $isBefore = 0;
                if ($request->phase == 2) {
                    if ($request->testEnum != 2) {
                        $check_time = ketquatest::where('maQuanLyQueTest', $request->maQuanLyQueTest)
                            ->whereBetween('thoiGian', [$request->firstDate, $request->endDate])
                            ->where('ketQua', '>', 50)
                            ->first();
                        if ($check_time) {
                            $isBefore = 1;
                        }
                    }
                }

                $lanTest = ($hoptestCount * 12) - $qlqt->soLuongQueTrung + 1;

                try {
                    if ($request->hasFile('image')) {
                        $url = $this->upload_image->handle($request, UrlImageS3Enum::TEST);

                        $ketquatest = ketquatest::create([
                            "maQuanLyQueTest" => $request->maQuanLyQueTest,
                            "maLoaiQue" => $request->maLoaiQue,
                            "lanTest" => $lanTest,
                            "thoiGian" => $request->thoiGian,
                            "ketQua" => $request->ketQua,
                            "device" => $request->device,
                            "image" => $url,
                        ]);
                    } else {
                        $ketquatest = ketquatest::create([
                            "maQuanLyQueTest" => $request->maQuanLyQueTest,
                            "maLoaiQue" => $request->maLoaiQue,
                            "lanTest" => $lanTest,
                            "thoiGian" => $request->thoiGian,
                            "ketQua" => $request->ketQua,
                            "device" => $request->device,
                        ]);
                    }
                } catch (Exception $e) {
                    return Responder::fail(null, $e);
                }

                if ($ketquatest) {
                    quanlyquetest::where('maNguoiDung', $request->maNguoiDung)->update([
                        'soLuongQueTrung' => $qlqt->soLuongQueTrung - 1
                    ]);

                    $test_result = test_result::where('testEnum', $request->testEnum)
                        ->where('type', $request->maLoaiQue)
                        ->where('phase', $request->phase)
                        ->where('isBefore', $isBefore)
                        ->first();

                    $maKetQuaTest = $ketquatest->maKetQuaTest;

                    $test_result->maKetQuaTest = $maKetQuaTest;

                    $test_result->ketQua = $request->ketQua;

                    return response()->json([
                        'data' => $test_result,
                        'message' => 'Cập nhật kết quả test thành công',
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'data' => null,
                        'message' => 'Cập nhật kết quả test thất bại',
                        'status' => true
                    ], 400);
                }
            } else if ($request->maLoaiQue == 2) {
                $lanTest = $hoptestCount - $qlqt->soLuongQueThai + 1;

                if ($request->hasFile('image')) {
                    $url = $this->upload_image->handle($request, UrlImageS3Enum::TEST);

                    $ketquatest = ketquatest::create([
                        "maQuanLyQueTest" => $request->maQuanLyQueTest,
                        "maLoaiQue" => $request->maLoaiQue,
                        "lanTest" => $lanTest,
                        "thoiGian" => $request->thoiGian,
                        "ketQua" => $request->ketQua,
                        "device" => $request->device,
                        "image" => $url,
                    ]);
                } else {
                    $ketquatest = ketquatest::create([
                        "maQuanLyQueTest" => $request->maQuanLyQueTest,
                        "maLoaiQue" => $request->maLoaiQue,
                        "lanTest" => $lanTest,
                        "thoiGian" => $request->thoiGian,
                        "ketQua" => $request->ketQua,
                        "device" => $request->device,
                    ]);
                }

                if ($ketquatest) {
                    quanlyquetest::where('maNguoiDung', $request->maNguoiDung)->update([
                        'soLuongQueThai' => $qlqt->soLuongQueThai - 1
                    ]);
                    if ($request->testEnum == 0) {
                        $test_result = test_result::find(30);

                        $test_result->maKetQuaTest = $ketquatest->maKetQuaTest;

                        $test_result->ketQua = $request->ketQua;

                        return response()->json([
                            'data' => $test_result,
                            'message' => 'Cập nhật kết quả test thành công',
                            'status' => true
                        ], 200);
                    } else if ($request->testEnum == 1) {
                        $test_result = test_result::find(27);

                        $test_result->maKetQuaTest = $ketquatest->maKetQuaTest;

                        $test_result->ketQua = $request->ketQua;

                        return response()->json([
                            'data' => $test_result,
                            'message' => 'Cập nhật kết quả test thành công',
                            'status' => true
                        ], 200);
                    }
                    return response()->json([
                        'data' => $ketquatest,
                        'message' => 'Cập nhật kết quả test thành công',
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'data' => null,
                        'message' => 'Cập nhật kết quả test thất bại',
                        'status' => true
                    ], 400);
                }
            }
            return response()->json([
                'message' => 'Không tồn tại que test',
                'status' => false
            ], 400);
        } else {
            return response()->json([
                'message' => 'Không tồn tại que test',
                'status' => false
            ], 400);
        }
    }
}
