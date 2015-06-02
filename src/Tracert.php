<?php namespace jorenvanhocht\Tracert;

use Illuminate\Database\DatabaseManager;
use jorenvanhocht\Tracert\Models\History;

class Tracert
{

    /**
     * @var \Illuminate\Database\Connection
     */
    protected $db;

    /**
     * @var object
     */
    protected $config;

    /**
     * @var History
     */
    protected $history;

    /**
     * @param DatabaseManager $db
     * @param History $history
     */
    public function __construct(DatabaseManager $db, History $history)
    {
        $this->db = $db->connection();
        $this->history = $history;
        $this->config = objectify(config('Tracert'));
    }


    /**
     * Log an action to the database
     *
     * @param $model
     * @param $row
     * @param $user_id
     * @param string $action
     */
    public function log($model, $row, $user_id, $action = 'created')
    {
        $history = new History;

        $history->hash = $this->makeUniqueHash($this->config->table, 'hash');
        $history->table = $model;
        $history->row = $row;
        $history->user_id = $user_id;
        $history->crud_action = $action;

        $history->save();
    }

    ///////////////////////////////////////////////////////////////////////////
    // Helper methods
    ///////////////////////////////////////////////////////////////////////////

    /**
     * @param $table
     * @param $field
     * @param int $min_length
     * @param int $max_length
     * @return string
     */
    public function makeUniqueHash( $table, $field, $min_length = 5, $max_length = 20 )
    {
        $hash   = '';
        $minus  = 0;

        // Generate a random length for the hash between the given min and max length
        $rand   = rand($min_length, $max_length);

        for ( $i = 0; $i < $rand; $i++ )
        {
            $char = rand( 0, strlen( $this->config->char_sets->hash));

            // When it's not the first char from the char_set make $minus equal to 1
            if( $char != 0 ? $minus = 1 : $minus = 0 );

            // Add the character to the hash
            $hash .= $this->config->char_sets->hash[ $char - $minus ];
        }

        // Check if the hash doest not exist in the given table and column
        if ( ! $this->db->table($table)->where($field, '=', $hash)->get() )
        {
            return $hash;
        }

        $this->makeUniqueHash($table, $field, $min_length, $max_length);
    }

}