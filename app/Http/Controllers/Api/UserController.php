<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return 'index';
    }

    public function detail($id)
    {
        return $id;
    }

    public function create(Request $request)
    {
        return $request;
    }
}
