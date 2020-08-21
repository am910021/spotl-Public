<?php

namespace App\Model\Logs;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int id
 * @property int user_id
 * @property string code
 * @property string pass
 * @property string item_type
 * @property int item_amount
 * @property int price
 * @property-read Carbon created_at
 * @property Carbon updated_at
 * @property-read User user
 */
class RedeemLog extends Model
{
    //
    protected function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public static function convert($myClass): RedeemLog
    {
        return $myClass;
    }
}
