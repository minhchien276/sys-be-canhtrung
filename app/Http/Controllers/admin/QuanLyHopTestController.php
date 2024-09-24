<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateQueTrungRequest;
use App\ServicesAdmin\QuanLyHopTestAdmin\CreateHopTest;
use App\ServicesAdmin\QuanLyHopTestAdmin\FeatureHopTest;
use App\ServicesAdmin\QuanLyHopTestAdmin\ShowHopTest;
use Illuminate\Http\Request;

class QuanLyHopTestController extends Controller
{
    private $showHopTest;
    private $createHopTest;
    private $featureHopTest;

    public function __construct(
        ShowHopTest $showHopTest,
        CreateHopTest $createHopTest,
        FeatureHopTest $featureHopTest,
    ) {
        $this->showHopTest = $showHopTest;
        $this->createHopTest = $createHopTest;
        $this->featureHopTest = $featureHopTest;
    }

    public function index()
    {
        return view('admin.hoptest.hopTestDaDung');
    }

    public function showHopTestDaDung()
    {
        return $this->showHopTest->showHopTestDaDung();
    }

    public function showHopTestMoi()
    {
        return $this->showHopTest->showHopTestMoi();
    }

    public function create(Request $request)
    {
        return $this->createHopTest->create($request);
    }

    public function loadHopTestList()
    {
        return $this->createHopTest->loadHopTestList();
    }

    public function countHopTest(Request $request)
    {
        return $this->featureHopTest->countHopTest($request);
    }

    public function addLuotTest($maQuanLyQueTest)
    {
        return $this->featureHopTest->addLuotTest($maQuanLyQueTest);
    }

    public function postThemQueTrung(UpdateQueTrungRequest $request, $maQuanLyQueTest)
    {
        return $this->featureHopTest->postThemQueTrung($request, $maQuanLyQueTest);
    }
}
