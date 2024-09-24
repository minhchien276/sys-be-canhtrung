<?php

namespace App\Http\Controllers;

use App\Services\Auth\getAllUsers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private $getAllUsers;

    public function __construct(
        getAllUsers $getAllUsers,
    ) {
        $this->getAllUsers = $getAllUsers;
    }

    public function getAllUsers()
    {
        return $this->getAllUsers->handle();
    }
}
