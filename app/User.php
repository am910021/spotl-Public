<?php

namespace App;

use App\Model\GameUsers;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property Carbon email_verified_at
 * @property string password
 * @property string remember_token
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon ban_time
 * @property int ban_type
 * @property string reg_ip
 * @property string last_ip
 * @property Carbon register_timestamp
 * @property boolean isBanned
 * @property boolean isAdmin
 * @property int game_id
 * @property GameUsers gameUser
 * @method static User find(int $int)
 */
class User extends Authenticatable
{
    use Notifiable;

    function __construct() {
        parent::__construct();
        $this->table = config("database.connections.mysql.database").'.users';
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

}
