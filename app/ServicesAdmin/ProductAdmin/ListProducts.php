<?php

namespace App\ServicesAdmin\ProductAdmin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ListProducts
{
    public function namGioi()
    {
        $products = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->select('sanpham.*', 'loaisanpham.name as category_name')
            ->where('sanpham.loaisanpham_id', 1)
            ->get();

        $products->map(function ($item) {
            if ($item->ngayTao) {
                $ngayTao = Carbon::createFromTimestamp($item->ngayTao / 1000);
                $item->ngayTao = $ngayTao->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.products.namGioi', compact('products'));
    }

    public function nuGioi()
    {
        $products = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->select('sanpham.*', 'loaisanpham.name as category_name')
            ->where('sanpham.loaisanpham_id', 4)
            ->get();

        $products->map(function ($item) {
            if ($item->ngayTao) {
                $ngayTao = Carbon::createFromTimestamp($item->ngayTao / 1000);
                $item->ngayTao = $ngayTao->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.products.nuGioi', compact('products'));
    }

    public function daVaLamDep()
    {
        $products = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->select('sanpham.*', 'loaisanpham.name as category_name')
            ->where('sanpham.loaisanpham_id', 7)
            ->get();

        $products->map(function ($item) {
            if ($item->ngayTao) {
                $ngayTao = Carbon::createFromTimestamp($item->ngayTao / 1000);
                $item->ngayTao = $ngayTao->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.products.chamSocDaVaLamDep', compact('products'));
    }

    public function meVaBe()
    {
        $products = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->select('sanpham.*', 'loaisanpham.name as category_name')
            ->where('sanpham.loaisanpham_id', 10)
            ->get();

        $products->map(function ($item) {
            if ($item->ngayTao) {
                $ngayTao = Carbon::createFromTimestamp($item->ngayTao / 1000);
                $item->ngayTao = $ngayTao->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.products.meVaBe', compact('products'));
    }

    public function tuoiDayThi()
    {
        $products = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->select('sanpham.*', 'loaisanpham.name as category_name')
            ->where('sanpham.loaisanpham_id', 13)
            ->get();

        $products->map(function ($item) {
            if ($item->ngayTao) {
                $ngayTao = Carbon::createFromTimestamp($item->ngayTao / 1000);
                $item->ngayTao = $ngayTao->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.products.tuoiDayThi', compact('products'));
    }
}
