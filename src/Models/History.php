<?php namespace jorenvanhocht\Tracert\Models;

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

    public function __construct()
    {
        parent::__construct([]);
        $this->table = config('tracert')['table'];
    }

}