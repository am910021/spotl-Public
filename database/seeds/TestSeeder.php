<?php

use App\Model\GameUsers;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $game = GameUsers::find(1);
        print($game);
        print("\r\n 1");
        print($game->webUser);
        print("\r\n 2");

        print($game->usr_register_timestamp);


    }
}
