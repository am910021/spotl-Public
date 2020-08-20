<?php

namespace App\Model\Game;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * @property-read int id
 * @property string usr_id
 * @property string code
 * @property string pass
 * @property string item_type
 * @property string item_amount
 * @property int price
 * @property Carbon timestamp
 */
class WebCodeRedemptionLog extends Model
{
    protected $connection = 'game';
    public $timestamps = false;

    function __construct()
    {
        parent::__construct();
        $database = DB::connection($this->connection)->getDatabaseName();
        $this->table = $database . '.web_code_redemption_log';
    }
}
