<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ServicesAdmin\BlogAdmin\CreateBlog;
use App\ServicesAdmin\BlogAdmin\DeleteBlog;
use App\ServicesAdmin\BlogAdmin\SearchBlog;
use App\ServicesAdmin\BlogAdmin\UpdateBlog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $createBlog;
    protected $deleteBlog;
    protected $updateBlog;
    protected $searchBlog;

    public function __construct(
        CreateBlog $createBlog,
        DeleteBlog $deleteBlog,
        UpdateBlog $updateBlog,
        SearchBlog $searchBlog,
    ) {
        $this->createBlog = $createBlog;
        $this->deleteBlog = $deleteBlog;
        $this->updateBlog = $updateBlog;
        $this->searchBlog = $searchBlog;
    }

    public function findByType($id)
    {
        return $this->searchBlog->findByType($id);
    }

    public function loadListBlog()
    {
        return $this->createBlog->loadListBlog();
    }

    public function create(Request $request)
    {
        return $this->createBlog->create($request);
    }

    public function delete($id)
    {
        return $this->deleteBlog->delete($id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateBlog->update($request, $id);
    }
}
