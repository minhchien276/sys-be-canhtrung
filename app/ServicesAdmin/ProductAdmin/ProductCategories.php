<?php

namespace App\ServicesAdmin\ProductAdmin;

use App\Models\loaisanpham;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductCategories
{
    public function createCategory()
    {
        return view('admin.products.createCategory');
    }

    public function storeCategory($request)
    {
        loaisanpham::create([
            'name' => $request->name,
            'phase' => $request->phase,
        ]);

        $products = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->select('sanpham.*', 'loaisanpham.name as category_name')
            ->get();

        $products->map(function ($item) {
            if ($item->ngayTao) {
                $ngayTao = Carbon::createFromTimestamp($item->ngayTao / 1000);
                $item->ngayTao = $ngayTao->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.products.index', compact('products'));
    }

    public function listCategories()
    {
        $list_categories = loaisanpham::get();

        return view('admin.products.listProductCategories', compact('list_categories'));
    }

    public function editCategory($id)
    {
        $category = loaisanpham::find($id);

        return view('admin.products.editCategory', compact('category'));
    }

    public function updateCategory($request, $id)
    {
        loaisanpham::where('id', $id)->update([
            'name' => $request->name,
            'phase' => $request->phase,
        ]);

        $list_categories = loaisanpham::get();

        return view('admin.products.listProductCategories', compact('list_categories'));
    }
}
