<?php

namespace App\Model\Logs;

use App\Model\GameUsers;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
/**
 * @property-read int id
 * @property-read Carbon created_at
 * @property Carbon updated_at
 * @property string number
 * @property string password
 * @property integer type
 * @property integer user_id
 * @property-read  User user
 */
class RedeemLog extends Model
{
    //



    protected function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
