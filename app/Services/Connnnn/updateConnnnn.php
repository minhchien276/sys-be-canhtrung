<?php

namespace App\Services\Connnnn;

use App\Enums\UrlImageS3Enum;
use App\Models\connnnn;
use App\Services\AWSS3\deleteImage;
use App\Services\AWSS3\uploadImage;
use App\Supports\Responder;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class updateConnnnn
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
                "ten" => $request->ten,
                "ngaySinh" => $request->ngaySinh,
                "gioiTinh" => $request->gioiTinh,
            ];

            $url = null;
            $connnnn = connnnn::findOrFail($id);
            // Kiểm tra xem file có tồn tại không trước khi lưu trữ
            if ($request->hasFile('image')) {
                // Lưu avatar mới lên S3
                $url = $this->upload_image->handle($request, UrlImageS3Enum::CHILDREN);
                $param['avatar'] = $url;
            }
            // Cập nhật thông tin người dùng
            $connnnn->update($param);

            DB::commit();
            return Responder::success($connnnn, 'Cập nhật thông tin thành công');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return Responder::fail(null, 'Không tìm thấy người bé');
        } catch (Exception $e) {
            DB::rollBack();
            return Responder::fail(null, 'Cập nhật thông tin thất bại: ' . $e->getMessage());
        }
    }
}
