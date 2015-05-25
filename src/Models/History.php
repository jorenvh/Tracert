<?php namespace jorenvanhocht\Tracert\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class History extends Model{

    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table        = 'history';


    /**
     * Set or unset the timestamps for the model
     *
     * @var bool
     */
    public $timestamps      = true;

    /**
     * Construct the class
     */
    public function __construct()
    {
        parent::__construct([]);
        $this->table = config('Tracert')['table'];
    }

    /*
   |--------------------------------------------------------------------------
   | Scopes
   |--------------------------------------------------------------------------
   |
   | For more information pleas check out the official Laravel docs at
   | http://laravel.com/docs/5.0/eloquent#query-scopes
   |
   */

    /**
     * @param $query
     * @param $user_id
     * @return mixed
     */
    public function scopeOnUser($query, $user_id)
    {
        return $query->whereUserId($user_id);
    }

    /**
     * @param $query
     * @param $table
     * @param $row
     * @return mixed
     */
    public function scopeOnTableRow($query, $table, $row)
    {
        return $query->whereTable($table)
                        ->whereRow($row);
    }

    /**
     * @param $query
     * @param $from
     * @param $to
     * @return mixed
     */
    public function scopeBetweenDates($query, $from, $to)
    {
        return $query->where('created_at', '>=', $from)
                        ->where('created_at', '<=', $to);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    |
    | For more information pleas check out the official Laravel docs at
    | http://laravel.com/docs/5.0/eloquent#accessors-and-mutators
    |
    */

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))->diffForHumans();
    }
}