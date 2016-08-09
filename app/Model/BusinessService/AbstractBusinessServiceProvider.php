<?php

namespace App\Model\BusinessService;

use Illuminate\Support\ServiceProvider;

abstract class AbstractBusinessServiceProvider extends ServiceProvider
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
}
