<?php

namespace App\Services\Auth;

use App\Enums\UrlImageS3Enum;
use App\Models\nguoidung;
use App\Services\AWSS3\deleteImage;
use App\Services\AWSS3\uploadImage;
use App\Supports\Responder;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class updateUser
{
    private $upload_image;
    private $delete_image;

    public function __construct(
        uploadImage $upload_image,
        deleteImage $delete_image,
    ) {
        $this->upload_image = $upload_image;
        $this->delete_image = $delete_image;
    }

    public function handle($request, $id)
    {
        try {
            DB::beginTransaction();
            $param = [
                'tenNguoiDung' => $request->tenNguoiDung,
                'chieuCao' => $request->chieuCao,
                'canNang' => $request->canNang,
            ];

            $url = null;
            $nguoidung = nguoidung::findOrFail($id);
            // Kiểm tra xem file có tồn tại không trước khi lưu trữ
            if ($request->hasFile('image')) {
                // Lưu avatar mới lên S3
                $url = $this->upload_image->handle($request, UrlImageS3Enum::AVATAR);
                $param['avatar'] = $url;
            }
            // Cập nhật thông tin người dùng
            $nguoidung->update($param);

            DB::commit();
            return Responder::success($nguoidung, 'Cập nhật thông tin thành công');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return Responder::fail(null, 'Không tìm thấy người người dùng');
        } catch (Exception $e) {
            DB::rollBack();
            return Responder::fail(null, 'Cập nhật thông tin thất bại: ' . $e->getMessage());
        }
    }
}
