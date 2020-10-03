<?php

namespace App\Rules;

use App\Model\GameUsers;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class UserModifyCheck implements Rule
{
    protected $wid;
    protected $gid;
    private $error = 0;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $wid, int $gid)
    {
        //
        $this->wid = $wid;
        $this->gid = $gid;
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

        if (count($users) != 0 && $users[0]->id != $this->wid) {
            $this->error = 1;
            return false;
        }
        if (count($games) != 0 && $games[0]->usr_id != $this->gid) {
            $this->error = 2;
            return false;
        }

        return 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->error == 1) {
            return __('validation.exist_in_web');
        } else if ($this->error == 2) {
            return __('validation.exist_in_game');
        }

        return __('validation.unique');
    }
}
