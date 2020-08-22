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
        $code = WebCode::find(528);

        $diffTime = Carbon::parse($code->effective_start)->diffInSeconds($code->effective_end);
        error_log($diffTime);

        error_log($code->effective_start==$code->effective_end);
        error_log(gettype($code->effective_start));

    }
}
