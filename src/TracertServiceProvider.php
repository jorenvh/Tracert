<?php namespace jorenvanhocht\Tracert;


use Illuminate\Support\ServiceProvider;
use jorenvanhocht\Tracert\Models\History;

class TracertServiceProvider extends ServiceProvider {

    /**
     * Register the service provider
     *
     * @return Tracert
     */
    public function register()
    {
        $this->app->bind('jorenvanhocht.tracert', function()
        {
            $db = $this->app['db'];
            $model = new History;
            return new Tracert($db, $model);
        });
    }

    /**
     * Load the resources
     *
     */
    public function boot()
    {
        // Publish the config file
        $this->publishes([
            __DIR__.'/../config' => config_path(),
        ], 'config');

        // Make the config file accessible even when the files are not published
        $this->mergeConfigFrom(__DIR__.'/../Config/Tracert.php', 'Tracert');
    }

}