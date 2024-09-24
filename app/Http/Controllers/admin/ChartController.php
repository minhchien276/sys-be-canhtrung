<?php

namespace App\Http\Controllers\admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\ServicesAdmin\ChartAdmin\AnswerAdmin;
use App\ServicesAdmin\ChartAdmin\FilterAdmin;
use App\ServicesAdmin\ChartAdmin\UserAdmin;
use App\ServicesAdmin\MilkAdmin\MilkService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ChartController extends Controller
{
    protected UserAdmin $userAdmin;
    protected FilterAdmin $filterAdmin;
    protected AnswerAdmin $answerAdmin;

    protected MilkService $milkService;

    public function __construct(
        UserAdmin $userAdmin,
        FilterAdmin $filterAdmin,
        AnswerAdmin $answerAdmin,
        MilkService $milkService,

    ) {
        $this->userAdmin = $userAdmin;
        $this->filterAdmin = $filterAdmin;
        $this->answerAdmin = $answerAdmin;
        $this->milkService = $milkService;
    }

    public function index()
    {
        return $this->userAdmin->index();
    }

    public function listUsers()
    {
        return $this->userAdmin->listUsers();
    }

    public function detailsUser($id)
    {
        return $this->userAdmin->detailsUser($id);
    }

    public function answers($id)
    {
        return $this->answerAdmin->answers($id);
    }

    public function breastMilk($id)
    {
        return $this->milkService->getBreastMilk($id);
    }

    public function sendNotification(Request $request)
    {
        return $this->answerAdmin->sendNotification($request);
    }

    public function updateKetQuaTest(Request $request)
    {
        return $this->answerAdmin->updateKetQuaTest($request);
    }

    public function filterAge(Request $request)
    {
        return $this->filterAdmin->filterAge($request);
    }

    public function filterPhase(Request $request)
    {
        return $this->filterAdmin->filterPhase($request);
    }

    public function showCon($maNguoiDung)
    {
        return $this->answerAdmin->showCon($maNguoiDung);
    }

    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function searchUser(Request $request)
    {
        return $this->userAdmin->searchUser($request);
    }
}
