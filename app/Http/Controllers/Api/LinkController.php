<?php

namespace App\Http\Controllers\Api;

use App\Services\Link\createLink;
use App\Services\Link\deleteLink;
use App\Services\Link\findLink;
use App\Services\Link\updateLink;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\Link\getLinkAnToan;
use App\Services\Link\getLinkConGai;
use App\Services\Link\getLinkConTrai;
use App\Services\Link\getLinkMeBe;

class LinkController extends Controller
{
    private $createLink;
    private $updateLink;
    private $findLink;
    private $deleteLink;
    private $getLinkConTrai;
    private $getLinkConGai;
    private $getLinkMeBe;
    private $getLinkAnToan;

    public function __construct(
        createLink $createLink,
        updateLink $updateLink,
        findLink $findLink,
        deleteLink $deleteLink,
        getLinkConTrai $getLinkConTrai,
        getLinkConGai $getLinkConGai,
        getLinkMeBe $getLinkMeBe,
        getLinkAnToan $getLinkAnToan,
    ) {
        $this->middleware('auth:api');
        $this->createLink = $createLink;
        $this->updateLink = $updateLink;
        $this->findLink = $findLink;
        $this->deleteLink = $deleteLink;
        $this->getLinkConTrai = $getLinkConTrai;
        $this->getLinkConGai = $getLinkConGai;
        $this->getLinkMeBe = $getLinkMeBe;
        $this->getLinkAnToan = $getLinkAnToan;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenLink' => 'required',
            'title' => 'required',
            'member' => 'required|numeric',
            'image' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $link = $this->createLink->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($link, 'Link created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenLink' => 'required',
            'title' => 'required',
            'member' => 'required|numeric',
            'image' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $link = $this->updateLink->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($link, 'Link updated successfully');
    }

    public function find($id)
    {
        try {
            $link = $this->findLink->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($link, 'find link successfully');
    }

    public function delete($id)
    {
        try {
            $link = $this->deleteLink->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($link, 'delete link successfully');
    }

    public function getLinkConTrai()
    {
        try {
            $link = $this->getLinkConTrai->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($link, 'find link successfully');
    }

    public function getLinkConGai()
    {
        try {
            $link = $this->getLinkConGai->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($link, 'find link successfully');
    }

    public function getLinkMeBe()
    {
        try {
            $link = $this->getLinkMeBe->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($link, 'find link successfully');
    }

    public function getLinkAnToan()
    {
        try {
            $link = $this->getLinkAnToan->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($link, 'find link successfully');
    }
}
