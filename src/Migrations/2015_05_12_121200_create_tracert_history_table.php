<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracertHistoryTable extends Migration {

    protected $config;

    public function __construct()
    {
        $this->config = objectify(config('Tracert'));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->config->table, function($table)
        {
            $table->increments('id');
            $table->string('hash', 80)->unique();
            $table->string('crud_action', 10);
            $table->string('table', 30);
            $table->integer('row');
            $table->boolean('last');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->config->table);
    }

}
