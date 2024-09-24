<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Http\Requests\createVoucherRequest;
use App\Http\Requests\updateVoucherRequest;
use App\Models\voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = voucher::orderBy('idTypeVoucher', 'asc')->get();

        return view('store.voucher.index', compact('vouchers'));
    }

    public function create()
    {
        return view('store.voucher.create');
    }

    public function store(createVoucherRequest $request)
    {
        voucher::create([
            'discount' => $request->discount,
            'minPrice' => $request->minPrice,
            'maxPrice' => $request->maxPrice,
            'status' => $request->status,
            'idTypeVoucher' => $request->idTypeVoucher,
            'expired' => $request->expired,
        ]);

        $vouchers = voucher::orderBy('idTypeVoucher', 'asc')->get();

        return view('store.voucher.index', compact('vouchers'));
    }

    public function edit($id)
    {
        $voucher = voucher::find($id);

        return view('store.voucher.edit', compact('voucher'));
    }

    public function update(updateVoucherRequest $request, $id)
    {
        voucher::where('id', $id)->update([
            'discount' => $request->discount,
            'minPrice' => $request->minPrice,
            'maxPrice' => $request->maxPrice,
            'status' => $request->status,
            'idTypeVoucher' => $request->idTypeVoucher,
            'expired' => $request->expired,
        ]);

        $vouchers = voucher::orderBy('idTypeVoucher', 'asc')->get();

        return view('store.voucher.index', compact('vouchers'));
    }
}
