<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\ServicesAdmin\AuthAdmin\AuthAdmin;
use App\ServicesAdmin\AuthAdmin\FeatureAdmin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authAdmin;
    protected $featureAdmin;

    public function __construct(
        AuthAdmin $authAdmin,
        FeatureAdmin $featureAdmin,
    ) {
        $this->authAdmin = $authAdmin;
        $this->featureAdmin = $featureAdmin;
    }

    public function login()
    {
        return $this->authAdmin->login();
    }

    public function signIn(Request $request)
    {
        return $this->authAdmin->signIn($request);
    }

    public function logout()
    {
        return $this->authAdmin->logout();
    }

    public function index()
    {
        return $this->featureAdmin->index();
    }

    public function typeAccounts($id)
    {
        return $this->featureAdmin->typeAccounts($id);
    }

    public function createQuyen(Request $request)
    {
        return $this->featureAdmin->createQuyen($request);
    }

    public function createAccount(Request $request)
    {
        return $this->featureAdmin->createAccount($request);
    }

    public function getPhanQuyen()
    {
        return $this->featureAdmin->getPhanQuyen();
    }

    public function loadListAcc()
    {
        return $this->featureAdmin->loadListAcc();
    }

    public function changePassword($id)
    {
        return $this->featureAdmin->changePassword($id);
    }

    public function updatePassword(ResetPasswordRequest $request, $id)
    {
        return $this->featureAdmin->updatePassword($request, $id);
    }

    public function delete($id)
    {
        return $this->featureAdmin->delete($id);
    }
}
