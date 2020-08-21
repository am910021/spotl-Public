<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Game\WebCode;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use const http\Client\Curl\AUTH_ANY;

class CodeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $response = array();
        $response['title'] = __('Code Manage');
        $response['data'] = array();
        $codes = array();
        $codes = WebCode::all();
        foreach ($codes as $code) {
            $temp = array('code' => $code->code, 'pass' => $code->pass, 'item_type' => $code->item_type, 'item_amount' => $code->item_amount,
                'item_amount' => $code->item_amount, 'generate_username' => $code->generate_username, 'generate_timestamp' => $code->generate_timestamp,
                'effective_start' => $code->effective_start, 'effective_end' => $code->effective_end, 'max_redemption' => $code->max_redemption,
                'remaining_redemption' => $code->remaining_redemption, 'price' => $code->price);
            array_push($response['data'], $temp);
        }

        return view('admin.code')->with($response);
    }

    public function query(Request $request)
    {
        $response = array();
        $response['title'] = __('Code Manage');
        $response['data'] = array();
        $codes = array();

        $start_time = $request->get('start_time');
        $end_time = $request->get('end_time');
        if ($start_time!="" and $end_time=="") {
            $start_time = Carbon::parse($start_time);
            $codes = WebCode::where([['generate_timestamp', '>=', $start_time->startOfDay()]])->get();
        } elseif ($start_time=="" and $end_time!="") {
            $end_time = Carbon::parse($end_time);
            $end_time->addDay();
            $codes = WebCode::where([['generate_timestamp', '<', $end_time->startOfDay()]])->get();
        } elseif ($start_time!="" and $end_time!="") {

            $start_time = Carbon::parse($start_time);
            $end_time = Carbon::parse($end_time);
            $end_time->addDay();
            $codes = WebCode::where([['generate_timestamp', '>=', $start_time->startOfDay()], ['generate_timestamp', '<', $end_time->startOfDay()]])->get();
        } else {
            $codes = WebCode::all();
        }
        foreach ($codes as $code) {
            $temp = array('code' => $code->code, 'pass' => $code->pass, 'item_type' => $code->item_type, 'item_amount' => $code->item_amount,
                'item_amount' => $code->item_amount, 'generate_username' => $code->generate_username, 'generate_timestamp' => $code->generate_timestamp,
                'effective_start' => $code->effective_start, 'effective_end' => $code->effective_end, 'max_redemption' => $code->max_redemption,
                'remaining_redemption' => $code->remaining_redemption, 'price' => $code->price);
            array_push($response['data'], $temp);
        }

        return redirect(route('admin.code'))->with($response)->withInput();
    }

    public function form()
    {
        $response = array();
        $response['title'] = __('Code Generate');
        $response['item_type'] = array(0 => '請選擇', 1 => '火卡', 2 => '水卡', 3 => '風卡', 4 => '土卡', 5 => '四屬卡', 6 => 'Code', 7 => 'Cash',
            8 => 'Skill-I卡', 9 => 'Skill-II卡', 1001 => '新手套裝(隨機屬性-30天超銀及全套金卡)',
            1002 => '新手小禮包(8000Cash-5000Card*4-Code10,000,000)',
            1003 => '新手大禮包(15000Cash-10000Card*4-Code30,000,000)');


        return view('admin.add')->with($response);
    }

    public function add(Request $request)
    {
        $response = array();
        $response['title'] = __('Code Manage');

        $type = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 1001, 1002, 1003);

        $validator = Validator::make($request->all(), [
            'security_code' => ['required', 'string', 'min:8', function ($attribute, $value, $fail) {
                $user = User::convert(Auth::user());

                if (!Hash::check($value, $user->security_code) || !$user->isAdmin || !$user->type != 1) {
                    return $fail(__('validation.security'));
                }
            }],
            'item_type' => ['required', 'numeric', Rule::in($type)],
            'item_amount' => ['required', 'numeric', 'min:1'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'max_redemption' => ['required', 'numeric', 'min:1'],
            'amount' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validator->fails()) {
            $response['status'] = 2;
            $response['item'] = '';
            return redirect(route('admin.code.add') . '#card-main')->with($response)
                ->withErrors($validator)
                ->withInput();
        }


        $i = 0;
        while ($i < $request->get('amount')) {
            $code = $this->generateRandomString(10);
            $pass = $this->generateRandomString(12);

            $codeC = WebCode::where('code', $code)->orWhere('pass', $pass)->count();
            if ($codeC > 0) {
                continue;
            }

            $webCode = new WebCode();
            $webCode->code = $code;
            $webCode->pass = $pass;
            $webCode->item_type = $request->get('item_type');
            $webCode->item_amount = $request->get('item_amount');
            $webCode->generate_username = Auth::user()->username;
            $webCode->generate_timestamp = Carbon::now();
            $webCode->effective_start = Carbon::parse($request->get('start_time'));
            $webCode->effective_end = Carbon::parse($request->get('end_time'));
            $webCode->max_redemption = $request->get('max_redemption');
            $webCode->remaining_redemption = $request->get('max_redemption');
            $webCode->price = $request->get('price');
            $webCode->save();
            $response['status'] = 1;
            $response['item'] = '';
            $i++;
        }
        return redirect(route('admin.code.add') . '#card-main')->with($response)->withInput();
    }


    private function generateRandomString($length = 22)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
