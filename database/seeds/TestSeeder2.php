<?php

use App\Model\Logs\RedeemLog;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class TestSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        $user = User::find(2);
//        print($user);
//        print("\r\n");
//        print($user->gameUser);
        $card = 100;
        $logC = RedeemLog::where('user_id', 1)->where(function ($query) use ($card) {
            $query->where('code', '%' . $card . '%');
        })->toSql();


        //orWhereBetween('item_type',[1001,1003])->toSql();
        error_log($logC);
    }
}
