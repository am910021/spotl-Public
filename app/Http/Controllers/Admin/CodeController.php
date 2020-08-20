<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CodeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $response = array();
        $response['title'] = __('Code Manage');
        $response['item_type'] = array(1 => '火卡', 2 => '水卡', 3 => '風卡', 4 => '土卡', 5 => '四屬卡', 6 => 'Code', 7 => 'Cash',
            8 => 'Skill-I卡', 9 => 'Skill-II卡', 1001 => '新手套裝(隨機屬性-30天超銀及全套金卡)',
            1002 => '新手小禮包(8000Cash-5000Card*4-Code10,000,000)',
            1003 => '新手大禮包(15000Cash-10000Card*4-Code30,000,000)');


        return view('admin.code')->with($response);
    }

    public function add(Request $request)
    {
        $response = array();
        $response['title'] = __('Code Manage');

        $type = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 1001, 1002, 1003);

        $validator = Validator::make($request->all(), [
            'security_code' => ['required', 'string', 'min:8'],
            'item_type' => ['required', 'numeric', Rule::in($type)],
            'item_amount' => ['required', 'numeric', 'min:1'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'max_redemption' => ['required', 'numeric', 'min:1'],
            'amount' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
        ]);


        return view('admin.code')->with($response);
    }
}
