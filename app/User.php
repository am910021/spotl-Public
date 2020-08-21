<?php

namespace App;

use App\Model\GameUsers;
use App\Model\Logs\RedeemLog;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read int id
 * @property string username
 * @property string email
 * @property Carbon email_verified_at
 * @property string password
 * @property string remember_token
 * @property-read Carbon created_at
 * @property Carbon updated_at
 * @property Carbon ban_time
 * @property int ban_type
 * @property string reg_ip
 * @property string last_ip
 * @property Carbon register_timestamp
 * @property boolean isBanned
 * @property boolean isAdmin
 * @property int game_id
 * @property-read GameUsers gameUser
 * @method static User find(int $int)
 * @property-read RedeemLog[] redeemLogs
 * @property string security_code
 * @property string auth_token
 * @property int type //127=normal user, 0=web admin
 */
class User extends Authenticatable
{
    use Notifiable;

    function __construct()
    {
        parent::__construct();
        $this->table = config("database.connections.mysql.database") . '.users';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function gameUser()
//    {
//        return $this->hasOne(GameUsers::class, "usr_id", "game_id");
//    }

    protected function gameUser()
    {
        return $this->belongsTo(GameUsers::class, "game_id");
    }

    protected function redeemLogs()
    {
        return $this->hasMany(RedeemLog::class, "user_id");
    }

    public static function convert($myClass): User
    {
        return $myClass;
    }
}
