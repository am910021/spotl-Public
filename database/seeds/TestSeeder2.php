<?php

use App\Model\Game\WebCode;
use App\Model\Logs\RedeemLog;
use App\User;
use Carbon\Carbon;
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
        $user   = User::find(8);
        error_log(json_encode($user->redeemLogs));

    }
}
