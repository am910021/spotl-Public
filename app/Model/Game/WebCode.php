<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @property-read int id
 * @property string code
 * @property string pass
 * @property int item_type
 * @property int item_amount
 * @property string generate_user
 * @property Carbon generate_timestamp
 * @property Carbon effective_start
 * @property Carbon effective_end
 * @property int max_redemption
 * @property int remaining_redemption
 * @property int price
 */
class WebCode extends Model
{
    protected $connection = 'game';
    public $timestamps = false;

    function __construct()
    {
        parent::__construct();
        $database = DB::connection($this->connection)->getDatabaseName();
        $this->table = $database . '.web_code';
    }

    public static function convert($myClass): WebCode
    {
        return $myClass;
    }
}
