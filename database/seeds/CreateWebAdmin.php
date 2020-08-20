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
        $username = $this->command->ask('請輸入管理員帳號');
        $password = '';
        $cPassword = '';

        $scode = '';
        $cscode = '';

        $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";

        $i = 0;
        while (true) {
            $i++;
            $password = $this->command->ask('請輸入密碼(英文+數字)');
            if(!preg_match($pattern, $password)){
                print('請輸入更安全的密碼。' . PHP_EOL);
                $i--;
                continue;
            }
            $cPassword = $this->command->ask('請確認密碼');
            if ($password != $cPassword) {
                if ($i >= 3) {
                    print('取消創建網頁管理員，確認密碼錯誤過多次。' . PHP_EOL);
                    return;
                } else {
                    print('密碼不相符，請重新輸入。' . PHP_EOL);
                }
            }else{
                break;
            }
        }

        $i = 0;
        while (true) {
            $i++;
            $scode = $this->command->ask('請輸入安全密碼(至少8位)');
            if($scode == '' || strlen($scode) < 8){
                print('請輸入8位安全密碼。' . PHP_EOL);
                $i--;
                continue;
            }

            $cscode = $this->command->ask('確認安全密碼');
            if ($scode != $cscode) {
                if ($i >= 3) {
                    print('取消創建網頁管理員，確認安全密碼錯誤過多次。' . PHP_EOL);
                    return;
                } else {
                    print('全密碼錯不相符，請重新輸入。' . PHP_EOL);
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
