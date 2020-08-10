<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Model\Logs\RedeemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RechargeRedeemController extends Controller
{
    //
    function index(){
        $response = array();

        $response['title'] = __('Recharge/Redeem (China only)');
        $response['status'] = 0; //nothing
        return view('member.rechargeAndRedeem')->with($response);
    }

    function redeem(Request $request){
        $response = array();
        $response['title'] = __('Recharge/Redeem (China only)');

        $validator = Validator::make($request->all(), [
            'cardNumber' => ['required','string'],
            'password' => ['required','string'],
        ]);

        if ($validator->fails()) {
            return redirect(route('member.rechargeAndRedeem').'#redeem')
                ->withErrors($validator)
                ->withInput();
        }
        //兌換失敗
        $response['status'] = 2; //1=success, 2=fail
        $response['msg'] = 'test';



        //兌換成功
        $redeemLog = new RedeemLog();
        $redeemLog->number = $request->get('cardNumber');
        $redeemLog->password = $request->get('password');
        $redeemLog->type = 0;
        $redeemLog->user_id = Auth::user()->id;
        $redeemLog->save();
        $response['status'] = 1; //1=success, 2=fail
        return view('member.rechargeAndRedeem')->with($response);
    }



}
