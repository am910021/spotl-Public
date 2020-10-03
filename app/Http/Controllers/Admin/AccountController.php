<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\GameUsers;
use App\Rules\EnglishNumberOnly;
use App\Rules\UserCheck;
use App\Rules\UserModifyCheck;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    //
    function index()
    {
        $response = array();
        $response['title'] = __('Account Manager');

        $gameUsers = GameUsers::all();
        $ul = array();
        foreach ($gameUsers as $gameUser) {
            $users = array();
            $user = $gameUser->webUser;
            $users['num'] = $user != null ? $user->id : "無";
            $users['gnum'] = $gameUser->usr_id;
            $users['username'] = $user != null ? $user->username : "無";
            $users['gusername'] = $gameUser->usr_name;
            $users['reg_time'] = $gameUser->usr_register_timestamp;
            $users['reg_ip'] = $gameUser->usr_reg_ip;
            $users['status'] = $gameUser->usr_ban_time == null ? '正常' : '封鎖中';
            $users['ban_time'] = $gameUser->usr_ban_time;
            array_push($ul, $users);
        }
        $response['users'] = $ul;
        return view('admin.account.index')->with($response);
    }

    function modifyShow(Request $request, int $gnum)
    {

        $gameUser = GameUsers::find($gnum);
        if ($gameUser == null) {
            return redirect(route('admin.account'));
        }

        if ($gameUser->webUser == null) {
            $user = new User();
            $user->username = $gameUser->usr_name;
            $user->email = $gameUser->usr_email;
            $user->password = Hash::make($gameUser->usr_pw);
            $user->reg_ip = $gameUser->usr_reg_ip;
            $user->last_ip = $gameUser->usr_last_ip;
            if ($gameUser->usr_register_timestamp == "0000-00-00 00:00:00") {
                $gameUser->usr_register_timestamp = Carbon::now();
                $gameUser->save();
            }
            $user->register_timestamp = Carbon::parse($gameUser->usr_register_timestamp);
            $user->game_id = $gameUser->usr_id;
            $user->save();
            $gameUser = GameUsers::find($gnum);
        }

        if ($gameUser->usr_ban_time < Carbon::now()->timestamp) {
            $gameUser->usr_ban_time = 0;
            $gameUser->save();
        }


        $response = array();
        $response['title'] = __('Modify Account') . ":  " . $gameUser->usr_name;
        $response['gnum'] = $gnum;
        $response['user'] = $gameUser->webUser;
        $response['gameUser'] = $gameUser;
        $response['gender_type'] = array(0 => '女', 1 => '男');

        return view('admin.account.modify')->with($response);
    }

    function modify(Request $request, int $gnum)
    {
        $gameUser = GameUsers::find($gnum);
        if ($gameUser == null) {
            return redirect(route('admin.account'));
        }
        $response = array();
        $response['title'] = __('Modify Manager');
        $response['status'] = 1;


        $webUser = $gameUser->webUser;

        $rules = [
            'web_username' => ['required', 'string', 'min:4', 'max:12', new UserModifyCheck($webUser->id, $gnum), new EnglishNumberOnly()],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string'],
            'gender' => ['required', 'digits_between:0,1'],
            'password' => ['nullable', 'string', 'min:6', 'max:12', 'confirmed', new EnglishNumberOnly()],
            'ban_to' => ['nullable', 'date_format:Y/m/d H:i'],
            'ban_type' => ['nullable', 'numeric'],
        ];

        $msg = [
            'gender.digits_between' => __('Please choose male or female')
        ];

        $validator = Validator::make($request->all(), $rules, $msg);

        if ($validator->fails()) {
            $response['status'] = 2;
            return redirect(route('admin.account.modify', $gnum) . "#card")->with($response)
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->get('web_username') != null &&
            ($request->get('web_username') != $webUser->username || $request->get('web_username') != $gameUser->usr_name)) {
            $webUser->username = $request->get('web_username');
            $gameUser->usr_name = $request->get('web_username');
        }

        if ($request->get('email') != null &&
            ($request->get('email') != $webUser->email || $request->get('email') != $gameUser->usr_email)) {
            $webUser->email = $request->get('email');
            $gameUser->usr_email = $request->get('email');
        }
        if ($request->get('phone') != null &&
            ($request->get('phone') != $gameUser->usr_phone)) {
            $gameUser->usr_phone = $request->get('phone');
        }
        if ($request->get('gender') != null &&
            ($request->get('gender') != $gameUser->usr_gender)) {
            $gameUser->usr_gender = $request->get('gender');
        }
        if ($request->get('password') != null) {
            $gameUser->usr_pw = $request->get('password');
            $webUser->password = Hash::make($request->get('password'));
        }
        if ($request->get('ban_type') != null && $request->get('ban_type') != $gameUser->usr_ban_type) {
            $gameUser->usr_ban_type = $request->get('ban_type');
        }
        if ($request->get('ban_to') != null) {
            $gameUser->usr_ban_time = Carbon::parse($request->get('ban_to'))->timestamp;
        }

        $gameUser->save();
        $webUser->save();


        return redirect(route('admin.account.modify', $gnum) . "#card")->with($response);

        return view('admin.account.index')->with($response);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        $response = array();
        $response['title'] = __('Add Account');
        $response['gender_type'] = array(-1 => '女/男', 0 => '女', 1 => '男');
        return view('admin.account.add')->with($response);
    }


    public function addUpdate(Request $request)
    {
        $response = array();
        $response['title'] = __('Add Account');
        $response['status'] = 1;

        $rules = [
            'username' => ['required', 'string', 'min:4', 'max:12', new UserCheck(), new EnglishNumberOnly()],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string'],
            'gender' => ['required', 'digits_between:0,1'],
            'password' => ['required', 'string', 'min:6', 'max:12', 'confirmed', new EnglishNumberOnly()],
        ];

        $msg = [
            'gender.digits_between' => __('Please choose male or female')
        ];

        $validator = Validator::make($request->all(), $rules, $msg);

        if ($validator->fails()) {
            $response['status'] = 2;
            return redirect(route('admin.account.add') . "#card")->with($response)
                ->withErrors($validator)
                ->withInput();
        }


        $data = $request->all();

        $game = new GameUsers();
        $game->usr_name = $data['username'];
        $game->usr_email = $data['email'];
        $game->usr_pw = $data['password'];
        $game->usr_reg_ip = '0.0.0.0';
        $game->usr_last_ip = '0.0.0.0';
        $game->usr_phone = $data['phone'];
        $game->usr_register_timestamp = Carbon::now();
        $game->usr_gender = $data['gender'];
        $game->save();

        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->reg_ip = '0.0.0.0';
        $user->last_ip = '0.0.0.0';
        $user->register_timestamp = Carbon::now();
        $user->game_id = $game->usr_id;
        $user->save();

        $response['account'] = $data['username'];
        return redirect(route('admin.account.add') . "#card")->with($response);


    }
}
