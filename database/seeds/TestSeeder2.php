<?php

use App\User;
use Illuminate\Database\Seeder;

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
        $user = User::find(1);
        print($user);
        print("\r\n");
        print($user->gameUser);
    }
}
