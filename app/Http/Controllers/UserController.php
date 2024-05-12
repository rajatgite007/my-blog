<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Exports\UserExport;
use App\Services\UserService;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    private $UserDataTable;
    private $UserService;

    public function __construct(
        UserDataTable $UserDataTable,
        UserService $UserService
    ) {
        $this->UserDataTable = $UserDataTable;
        $this->UserService = $UserService;
    }

    public function index(Request $request)
    {
        return $this->UserDataTable->render('users.index');
    }
}
