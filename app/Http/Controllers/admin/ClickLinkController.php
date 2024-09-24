<?php

namespace App\Http\Controllers\admin;

use App\Exports\ClickLinkExport;
use App\Http\Controllers\Controller;
use App\ServicesAdmin\ClickLink\CheckClick;
use App\ServicesAdmin\ClickLink\IndexClickLink;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClickLinkController extends Controller
{
    private $indexClickLink;
    private $checkClick;

    public function __construct(
        IndexClickLink $indexClickLink,
        CheckClick $checkClick,
    ) {
        $this->indexClickLink = $indexClickLink;
        $this->checkClick = $checkClick;
    }

    public function index(Request $request)
    {
        return $this->indexClickLink->index($request);
    }

    public function checkClicks(Request $request)
    {
        return $this->checkClick->checkClicks($request);
    }

    public function checkClicksMonth(Request $request)
    {
        return $this->checkClick->checkClicksMonth($request);
    }

    public function exportClickLink()
    {
        return Excel::download(new ClickLinkExport, 'clicklink.xlsx');
    }
}
