<?php

namespace App\Model;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int usr_id
 * @property string usr_name
 * @property string usr_pw
 * @property int usr_ban_time
 * @property int usr_ban_type
 * @property string usr_reg_ip
 * @property string usr_last_ip
 * @property int usr_gender
 * @property int usr_char
 * @property int usr_points
 * @property int usr_level
 * @property int usr_code
 * @property int usr_coins
 * @property int usr_cash
 * @property int usr_water
 * @property int usr_fire
 * @property int usr_earth
 * @property int usr_wind
 * @property int usr_nslots
 * @property int usr_wins
 * @property int usr_losses
 * @property int usr_ko
 * @property int usr_down
 * @property int usr_scroll1
 * @property int usr_scroll2
 * @property int usr_scroll3
 * @property int usr_mission
 * @property int usr_last_login
 * @property int usr_channel
 * @property string usr_salt
 * @property int usr_admin
 * @property string usr_guild
 * @property string usr_guildduty
 * @property int usr_guild_permission_level
 * @property int usr_vip
 * @property int usr_LotteryTimes
 * @property float usr_evo
 * @property string fingerprint
 * @property string usr_email
 * @property int usr_spam
 * @property int usr_wrongpwtime
 * @property int usr_getele
 * @property int usr_force_exitchannel
 * @property string usr_phone
 * @property int usr_trade
 * @property Carbon usr_register_timestamp
 * @property User webUser
 * @method static GameUsers find(int $int)
 */
class GameUsers extends Model
{
    //

    function __construct()
    {
        parent::__construct();
        $this->table = config("database.connections.game.database") . '.users';
    }

    protected $connection = 'game';
    protected $primaryKey = 'usr_id';
    public $timestamps = false;

    protected function webUser()
    {
        return $this->hasOne(User::class, "game_id");
    }

    public static function convert($myClass): GameUsers
    {
        return $myClass;
    }

}
