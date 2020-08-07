<?php

namespace App\Rules;

use App\Model\GameUsers;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class UserCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $users = User::where('username', $value)->get();
        $games = GameUsers::where('usr_name', $value)->get();


        return count($users) == 0 and count($games) == 0;


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.unique');
    }
}
