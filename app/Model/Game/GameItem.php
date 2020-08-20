<?php

namespace App\Model\Game;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property-read  int itm_id
 * @property int itm_slot
 * @property int itm_usr_id
 * @property int itm_type
 * @property int itm_gf
 * @property int itm_level
 * @property int itm_skill
 * @property int itm_on
 * @property Carbon itm_timestamp
 * @property int itm_trade
 * @property int itm_newbiepacket
 */
class GameItem extends Model
{
    protected $connection = 'game';
    protected $primaryKey = 'itm_id';
    public $timestamps = false;

    function __construct()
    {
        parent::__construct();
        $database = DB::connection($this->connection)->getDatabaseName();
        $this->table = $database . '.items';
    }

    public static function convert($myClass): GameItem
    {
        return $myClass;
    }
}
