<?php

namespace App\Model;

use Illuminate\Support\ServiceProvider;

/**
 * Base for the automated business service provider layer
 */
class BusinessServiceProvider extends ServiceProvider
{
    /**
     * Errors array to be treated before sending to the frontend
     * @var array
     */
    protected $_errors = array();

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(get_class($this));
    }

    /**
     * Get Errors array
     * @return [type] [description]
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * [setApp description]
     * @param \Illuminate\Contracts\Foundation\Application  $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }
}
