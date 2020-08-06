<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $user = new \App\User();
        $user->name = "t1";
        $user->password=Hash::make("test");
        $user->reg_ip = "0.0.0.0";
        $user->last_ip = "0.0.0.0";
        $user->email="test@localhost";
$user->register_timestamp = \Carbon\Carbon::now();
$user->game_id = 1;
$user->save();

    }
}
