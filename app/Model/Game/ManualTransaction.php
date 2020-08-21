<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @property-read  int Id
 * @property string payer
 * @property string payment_time
 * @property string amount
 * @property string IGname
 * @property string cash_amount
 * @property string handle_time
 * @property string handle_note
 * @property string handler
 */
class ManualTransaction extends Model
{
    protected $connection = 'game';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    function __construct()
    {
        parent::__construct();
        $database = DB::connection($this->connection)->getDatabaseName();
        $this->table = $database . '.manual_transaction';
    }

    public static function convert($myClass): ManualTransaction
    {
        return $myClass;
    }   //
}
