<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Blog\createBlog;
use App\Services\Blog\deleteBlog;
use App\Services\Blog\getBlogByType;
use App\Services\Blog\getBlogByTypeV2;
use App\Services\Blog\updateBlog;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBlogController extends Controller
{
    private $createBlog;
    private $getBlogByType;
    private $getBlogByTypeV2;
    private $updateBlog;
    private $deleteBlog;

    public function __construct(
        createBlog $createBlog,
        getBlogByType $getBlogByType,
        getBlogByTypeV2 $getBlogByTypeV2,
        updateBlog $updateBlog,
        deleteBlog $deleteBlog,
    ) {
        $this->middleware('auth:api');
        $this->createBlog = $createBlog;
        $this->getBlogByType = $getBlogByType;
        $this->getBlogByTypeV2 = $getBlogByTypeV2;
        $this->updateBlog = $updateBlog;
        $this->deleteBlog = $deleteBlog;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'content' => 'required',
            'link' => 'required',
            'date' => 'required|numeric',
            'type_blog_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $blog = $this->createBlog->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($blog, 'Blog created successfully');
    }

    public function getBlogByType($type_blog_id)
    {
        try {
            $blog = $this->getBlogByType->handle($type_blog_id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($blog, 'Blog get successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'content' => 'required',
            'link' => 'required',
            'date' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $blog = $this->updateBlog->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($blog, 'Blog updated successfully');
    }

    public function delete($id)
    {
        try {
            $blog = $this->deleteBlog->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($blog, 'Blog deleted successfully');
    }

    public function getBlogByTypeV2($type_blog_id)
    {
        try {
            $blog = $this->getBlogByTypeV2->handle($type_blog_id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($blog, 'Blog get successfully');
    }
}
