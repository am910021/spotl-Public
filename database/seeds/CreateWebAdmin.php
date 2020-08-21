<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateWebAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $username = $this->command->ask('Enter admin name');
        $password = '';
        $cPassword = '';

        $scode = '';
        $cscode = '';

        $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";

        $i = 0;
        while (true) {
            $i++;
            $password = $this->command->ask('Enter password(char+number)');
            if(!preg_match($pattern, $password)){
                print('Please re-enter, the password is not secure enough.' . PHP_EOL);
                $i--;
                continue;
            }
            $cPassword = $this->command->ask('Check password');
            if ($password != $cPassword) {
                if ($i >= 3) {
                    print('Cancel the creation of a web administrator and confirm that the password has been incorrect for many times.' . PHP_EOL);
                    return;
                } else {
                    print('The passwords do not match, please re-enter.' . PHP_EOL);
                }
            }else{
                break;
            }
        }

        $i = 0;
        while (true) {
            $i++;
            $scode = $this->command->ask('Please enter a security password (at least 8 char)');
            if($scode == '' || strlen($scode) < 8){
                print('Please enter an 8-char security code.' . PHP_EOL);
                $i--;
                continue;
            }

            $cscode = $this->command->ask('Confirm security password');
            if ($scode != $cscode) {
                if ($i >= 3) {
                    print('Cancel the creation of a web administrator, and confirm that the security password has been wrong for many times.' . PHP_EOL);
                    return;
                } else {
                    print('The password is wrong and does not match, please re-enter.' . PHP_EOL);
                }
            }else{
                break;
            }
        }


        $user = new User();
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->security_code = Hash::make($cscode);
        $user->isAdmin = true;
        $user->type = 0;
        $user->reg_ip='127.0.0.1';
        $user->last_ip='127.0.0.1';
        $user->save();
    }
}
