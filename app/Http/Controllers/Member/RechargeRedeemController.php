<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Model\Game\GameItem;
use App\Model\Game\ManualTransaction;
use App\Model\Game\Transaction;
use App\Model\Game\WebCode;
use App\Model\GameUsers;
use App\Model\Logs\RedeemLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RechargeRedeemController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('member');
    }

    function index()
    {
        $response = array();

        $response['title'] = __('Recharge/Redeem (China only)');
        $response['status'] = 0; //nothing
        return view('member.rechargeAndRedeem')->with($response);
    }

    function redeem(Request $request)
    {
        $response = array();
        $response['title'] = __('Recharge/Redeem (China only)');

        $validator = Validator::make($request->all(), [
            'cardNumber' => ['required', 'string', 'size:10'],
            'password' => ['required', 'string', 'size:12'],
        ]);

        if ($validator->fails()) {
            return redirect(route('member.rechargeAndRedeem') . '#redeem')
                ->withErrors($validator)
                ->withInput();
        }

        $code = $request->get('cardNumber');
        $pass = $request->get('password');

        //兌換失敗
        $redeems = WebCode::where([['code', 'like', '%' . $code . '%'], ['pass', 'like', '%' . $pass . '%']])->get();
        if (count($redeems) == 0) {
            $response['status'] = 2; //1=success, 2=fail
            $response['msg'] = 'NOTEXIST。';
            return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
        }

        $redeem = WebCode::convert($redeems[0]);

        error_log($redeem->effective_start);
        error_log(gettype($redeem->effective_start));


        $diffTime = Carbon::parse($redeem->effective_start)->diffInSeconds(Carbon::now());
        if ($diffTime < 0) {
            $response['status'] = 2; //1=success, 2=fail
            $response['msg'] = 'NOTSTARTED';
            $response['date'] = $redeem->effective_start;
            return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
        }

        $diffTime = Carbon::now()->diffInSeconds($redeem->effective_end);
        if ($diffTime < 0) {
            $response['status'] = 2; //1=success, 2=fail
            $response['msg'] = 'EXPIRED';
            return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
        }

        if ($redeem->remaining_redemption <= 0) {
            $response['status'] = 2; //1=success, 2=fail
            $response['msg'] = 'MAX';
            return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
        }

        $item_type = $redeem->item_type;
        $item_amount = $redeem->item_amount;
        $price = $redeem->price;

        if ($item_type == 1001 ) {
            $logC = RedeemLog::where('user_id', Auth::user()->id)->where('item_type', 1001)->count();
            if ($logC > 0) {
                $response['status'] = 2; //1=success, 2=fail
                $response['msg'] = 'TYPEUSED';
                return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
            }
        }

        if ($item_type == 1002 ) {
            $logC = RedeemLog::where('user_id', Auth::user()->id)->where('item_type', 1002)->count();

            if ($logC > 0) {
                $response['status'] = 2; //1=success, 2=fail
                $response['msg'] = 'TYPEUSED';
                return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
            }
        }

        if ($item_type == 1003) {
            $logC = RedeemLog::where('user_id', Auth::user()->id)->where('item_type', 1003)->count();
            if ($logC > 0) {
                $response['status'] = 2; //1=success, 2=fail
                $response['msg'] = 'TYPEUSED';
                return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
            }
        }

        if ($item_type >= 1 && $item_type <= 9) {
            $logC = RedeemLog::where('user_id', Auth::user()->id)->where(function ($query) use ($code) {
                $query->where('code', '%' . $code . '%');
            })->count();
            if ($logC > 0) {
                $response['status'] = 2; //1=success, 2=fail
                $response['msg'] = 'USED';
                return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
            }

        }

        //check if user has sufficient space
        $space_required = 0;
        $used_slot = array();
        $free_slot = array();
        switch ($item_type) {

            case 8:
                $space_required = 1;
                break;
            case 9: //  case 8 ?
                $space_required = 1;
                break;
            case 1001:
                $space_required = 10;
                break;
//            case 1002:
//                $space_required = 10;
//                break;
//            case 1003:
//                $space_required = 10;
//                break;
            default:
                break;
        }

        $items = GameItem::where('itm_usr_id', Auth::user()->id)->orderBy('itm_slot')->get();
        $itemC = count($items);
        if ((96 - $itemC) < $space_required) {
            $response['status'] = 2; //1=success, 2=fail
            $response['msg'] = 'NOSPACE';
            return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
        }

        if ($itemC == 0) {
            for ($i = 0; $i < 96; $i++) {
                array_push($free_slot, $i);
            }
        } else {
            foreach ($items as $item) {
                array_push($used_slot, $item->itm_slot);
            }
            for ($i = 0; $i < 96; $i++) {
                if (!in_array($i, $used_slot)) {
                    array_push($free_slot, $i);
                }
            }
        }

        $redeem->remaining_redemption -= 1;
        $redeem->save();

        //兌換成功
        $log = new RedeemLog();
        $log->user_id = Auth::user()->id;
        $log->code = $code;
        $log->pass = $pass;
        $log->item_type = $item_type;
        $log->item_amount = $item_amount;
        $log->price = $price;
        $log->save();
        $response['status'] = 1; //1=success, 2=fail
        $response['item'] = '';
        $this->addItem($item_type, $item_amount, $free_slot, $response);
        return redirect(route('member.rechargeAndRedeem') . '#redeem')->with($response)->withInput();
    }

    private function addItem(int $item_type, int $item_amount, array $free_slot, array &$ret)
    {
        $gameUser = GameUsers::convert(Auth::user()->gameUser);

        switch ($item_type) {
            case 1:
                $ret['item'] = $item_amount . "  fire cards";
                $gameUser->usr_fire += $item_amount;
                $gameUser->save();
                break;

            case 2:
                $ret['item'] = $item_amount . "  water cards";
                $gameUser->usr_water += $item_amount;
                $gameUser->save();
                break;

            case 3:
                $ret['item'] = $item_amount . "  wind cards";
                $gameUser->usr_wind += $item_amount;
                $gameUser->save();
                break;

            case 4:
                $ret['item'] = $item_amount . "  earth cards";
                $gameUser->usr_earth += $item_amount;
                $gameUser->save();
                break;

            case 5:
                $gameUser->usr_fire += $item_amount;
                $gameUser->usr_wind += $item_amount;
                $gameUser->usr_water += $item_amount;
                $gameUser->usr_earth += $item_amount;
                $gameUser->save();
                $ret['item'] = $item_amount . "  of each type of elemental cards";
                break;

            case 6:
                $ret['item'] = $item_amount . "  code";
                $gameUser->usr_code += $item_amount;
                error_log($item_amount);
                error_log($gameUser->usr_code);

                $gameUser->save();
                break;


            case 7:
                $ret['item'] = $item_amount . "  cash";
                $gameUser->usr_cash += $item_amount;
                $gameUser->save();
                //require_once '../../FunG_Function.php';
                //GetDonationSum($_SESSION['usr_name']);
                $this->getDonationSum();
                break;

            case 8:
                $ret['item'] = "Skill-1 (" . $item_amount . "-time(s) use) Card";
                $item = new GameItem();
                $item->itm_slot = $free_slot[0];
                $item->itm_usr_id = Auth::user()->id;
                $item->itm_type = 2015;
                $item->itm_gf = 6000;
                $item->itm_level = $item_amount;
                $item->save();
                break;

            case 9:
                $ret['item'] = "Skill-2 (" . $item_amount . "-time(s) use) Card";
                $item = new GameItem();
                $item->itm_slot = $free_slot[0];
                $item->itm_usr_id = Auth::user()->id;
                $item->itm_type = 2016;
                $item->itm_gf = 6000;
                $item->itm_level = $item_amount;
                $item->save();
                break;

            case 1001;
                $element = rand(1, 4) * 10;
                $item_list = array(1101, 1102, 1103, 1104, 1201, 1202, 1203, 1204, 1301, 2900);
                for ($i = 0; $i < 10; $i++) {
                    $item = new GameItem();
                    $item->itm_gf = 30;
                    $item->itm_level = 0;
                    $item->itm_timestamp = Carbon::now()->addDays(30);
                    $item->itm_trade = 0;
                    $item->itm_newbiepacket = 1;
                    if ($i != 9) {
                        $item->itm_slot = $free_slot[$i];
                        $item->itm_usr_id = User::convert(Auth::user())->game_id;
                        $item->itm_type = ($item_list[$i] + $element);
                    } else {
                        $item->itm_slot = $free_slot[$i];
                        $item->itm_usr_id = User::convert(Auth::user())->game_id;
                        $item->itm_type = ($item_list[$i] + $element / 10);
                    }
                    $item->save();
                }
                $ret['item'] = "The Beginner Pack (30-day Super Silver Card & a set of 30-day Gold Equipment Cards of random element included)";
                //require_once '../../FunG_Function.php';
                //GetDonationSum($_SESSION['usr_name']);
                $this->getDonationSum();
                break;

            case 1002;
                $gameUser->usr_water += 5000;
                $gameUser->usr_fire += 5000;
                $gameUser->usr_earth += 5000;
                $gameUser->usr_wind += 5000;
                $gameUser->usr_cash += 8000;
                $gameUser->usr_code += 10000000;
                $gameUser->save();
                $ret['item'] = "The Beginner Pack (Cash 8000 & Card 5000*4 & Code 10,000,000)";
                //require_once '../../FunG_Function.php';
                //GetDonationSum($_SESSION['usr_name']);
                $this->getDonationSum();
                break;

            case 1003;
                $gameUser->usr_water += 10000;
                $gameUser->usr_fire += 10000;
                $gameUser->usr_earth += 10000;
                $gameUser->usr_wind += 10000;
                $gameUser->usr_cash += 15000;
                $gameUser->usr_code += 30000000;
                $gameUser->save();
                $ret['item'] = "The Beginner Pack (Cash 15000 & Card 10000*4 & Code 30,000,000)";
                //require_once '../../FunG_Function.php';
                //GetDonationSum($_SESSION['usr_name']);
                $this->getDonationSum();
                break;
            default:
                $ret['status'] = 2;
                $ret['item'] = '兌換錯誤，請聯絡管理員。';
        }

    }

    private function getDonationSum()
    {
        $user = User::convert(Auth::user());
        $gameUser = $user->gameUser;

        if ($gameUser->usr_trade == 0) {
            $unlock_trade_cash = 20000;
            $SumCash = 0;
            $manuals = ManualTransaction::where('IGname', $user->username)->get();
            foreach ($manuals as $manual) {

                $SumCash += intval($manual->cash_amount);
            }

            $logs = $user->redeemLogs;

            foreach ($logs as $log) {
                if ($log->item_type == 1001) {
                    $SumCash += 8000;
                } else if ($log->item_type == 1002) {
                    $SumCash += 15000;
                } else if ($log->item_type == 7) {
                    $SumCash += $log->item_amount;
                }
            }

            $trans = Transaction::where('user_id', $gameUser->usr_id)->get();
            foreach ($trans as $tran) {
                $SumCash += intval($tran->cash);
            }

            if ($SumCash >= $unlock_trade_cash) {
                $gameUser->usr_trade = 1;
                $gameUser->save();
            }
        }
    }

}
