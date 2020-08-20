<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $response = array();
        $response['title'] = '管理員首頁';
        return view('admin.main')->with($response);
    }
}
