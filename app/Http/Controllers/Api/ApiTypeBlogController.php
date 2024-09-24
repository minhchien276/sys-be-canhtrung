<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TypeBlog\createTypeBlog;
use App\Services\TypeBlog\deleteTypeBlog;
use App\Services\TypeBlog\getTypeBlog;
use App\Services\TypeBlog\updateTypeBlog;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTypeBlogController extends Controller
{
    private $createTypeBlog;
    private $updateTypeBlog;
    private $deleteTypeBlog;
    private $getTypeBlog;

    public function __construct(
        createTypeBlog $createTypeBlog,
        updateTypeBlog $updateTypeBlog,
        deleteTypeBlog $deleteTypeBlog,
        getTypeBlog $getTypeBlog,
    ) {
        $this->middleware('auth:api');
        $this->createTypeBlog = $createTypeBlog;
        $this->updateTypeBlog = $updateTypeBlog;
        $this->deleteTypeBlog = $deleteTypeBlog;
        $this->getTypeBlog = $getTypeBlog;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $blog = $this->createTypeBlog->handle($request);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($blog, 'TypeBlog created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $typeBlog = $this->updateTypeBlog->handle($request, $id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($typeBlog, 'TypeBlog updated successfully');
    }

    public function delete($id)
    {
        try {
            $typeblog = $this->deleteTypeBlog->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($typeblog, 'TypeBlog deleted successfully');
    }

    public function get($phase)
    {
        try {
            $typeblog = $this->getTypeBlog->handle($phase);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($typeblog, 'TypeBlog get successfully');
    }
}
