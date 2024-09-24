<?php

namespace App\ServicesAdmin\ProductAdmin;

use App\Models\loaisanpham;
use App\Models\sanpham;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EditProduct
{
    public function edit($id)
    {
        $product = sanpham::find($id);

        $loaisp = loaisanpham::get();

        return view('admin.products.editProduct', compact('product', 'loaisp'));
    }

    public function update($request, $id)
    {
        $ngayTao = Carbon::now()->format('d-m-Y H:i:s');

        $milliseconds = strtotime($ngayTao) * 1000;

        sanpham::where('id', $id)->update([
            'name' => $request->name,
            'image' => $request->image,
            'keyword' => $request->keyword,
            'sold' => $request->sold,
            'loaisanpham_id' => $request->loaisanpham_id,
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
}
