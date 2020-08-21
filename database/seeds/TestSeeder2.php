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
        $codeC = WebCode::orWhere(function ($query) {
            $query->where('code', 1)
                ->where('pass', 1);
        });

        $codeC = WebCode::where('code', 1)->orWhere('pass', 1);
        error_log($codeC->toSql());
        error_log(Carbon::parse('2020/08/21 18:03'));

    }
}
