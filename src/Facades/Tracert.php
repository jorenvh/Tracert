<?php namespace jorenvanhocht\Tracert\Facades;

use Illuminate\Support\Facades\Facade;

class Tracert extends Facade{
    protected static function getFacadeAccessor() { return 'jorenvanhocht.tracert'; }
}