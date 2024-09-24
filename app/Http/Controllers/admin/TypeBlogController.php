<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ServicesAdmin\TypeBlogAdmin\CreateTypeBlog;
use App\ServicesAdmin\TypeBlogAdmin\DeleteTypeBlog;
use App\ServicesAdmin\TypeBlogAdmin\IndexTypeBlog;
use App\ServicesAdmin\TypeBlogAdmin\UpdateTypeBlog;
use Illuminate\Http\Request;

class TypeBlogController extends Controller
{
    private $createTypeBlog;
    private $deleteTypeBlog;
    private $updateTypeBlog;
    private $indexTypeBlog;

    public function __construct(
        CreateTypeBlog $createTypeBlog,
        DeleteTypeBlog $deleteTypeBlog,
        UpdateTypeBlog $updateTypeBlog,
        IndexTypeBlog $indexTypeBlog,
    ) {
        $this->createTypeBlog = $createTypeBlog;
        $this->deleteTypeBlog = $deleteTypeBlog;
        $this->updateTypeBlog = $updateTypeBlog;
        $this->indexTypeBlog = $indexTypeBlog;
    }

    public function index()
    {
        return $this->indexTypeBlog->index();
    }

    public function create(Request $request)
    {
        return $this->createTypeBlog->create($request);
    }

    public function loadListTypeBlog()
    {
        return $this->createTypeBlog->loadListTypeBlog();
    }

    public function delete($id)
    {
        return $this->deleteTypeBlog->delete($id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateTypeBlog->update($request, $id);
    }
}
