<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\GameUsers;
use App\Providers\RouteServiceProvider;
use App\Rules\UserCheck;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $database = DB::connection("game")->getDatabaseName();

        $rules = [
            'username' => ['required', 'string', 'max:255', new UserCheck()],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string'],
            'gender' => ['required', 'digits_between:0,1'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $msg = [
            'gender.digits_between' => __('Please choose male or female')
        ];


        return Validator::make($data, $rules, $msg);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $data = $request->all();

        $game = new GameUsers();
        $game->usr_name = $data['username'];
        $game->usr_email = $data['email'];
        $game->usr_pw = $data['password'];
        $game->usr_reg_ip = $request->ip();
        $game->usr_last_ip = $request->ip();
        $game->usr_phone = $data['phone'];
        $game->usr_register_timestamp = Carbon::now();
        $game->usr_gender = $data['gender'];
        $game->save();

        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->reg_ip = $request->ip();
        $user->last_ip = $request->ip();
        $user->register_timestamp = Carbon::now();
        $user->game_id = $game->usr_id;
        $user->save();

        return $user;
    }


    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request)));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $response = array();
        $response['title'] = __('Register');
        return view('auth.register2')->with($response);
    }
}
