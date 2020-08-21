<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property-read  int id
 * @property string username
 * @property int user_id
 * @property string txn_id
 * @property string payment_date
 * @property float amount_from_string
 * @property float amount_received
 * @property string cash
 * @property int success
 * @property string reason
 */
class Transaction extends Model
{
    protected $connection = 'game';
    protected $primaryKey = 'id';
    public $timestamps = false;

    function __construct()
    {
        parent::__construct();
        $database = DB::connection($this->connection)->getDatabaseName();
        $this->table = $database . '.transaction';
    }

    public static function convert($myClass): Transaction
    {
        return $myClass;
    }   //
}
