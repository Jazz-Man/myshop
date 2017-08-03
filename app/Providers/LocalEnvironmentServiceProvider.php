<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LocalEnvironmentServiceProvider extends ServiceProvider
{
    
    protected $providers
      = [
        \Barryvdh\Debugbar\ServiceProvider::class,
        \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
//        \Laracasts\Generators\GeneratorsServiceProvider::class,
//        \Orangehill\Iseed\IseedServiceProvider::class
      ];
    
    protected $aliases
      = [
        'Debugbar' => 'Barryvdh\Debugbar\Facade',
      ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ( $this->app->environment() === 'local' ) {
            $this->registerServiceProviders();
            $this->registerFacadeAliases();
        }
    }
    
    protected function registerServiceProviders() {
        foreach ( $this->providers as $provider ) {
            $this->app->register( $provider );
        }
    }
    
    public function registerFacadeAliases() {
        $loader = AliasLoader::getInstance();
        foreach ( $this->aliases as $alias => $facade ) {
            $loader->alias( $alias, $facade );
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
