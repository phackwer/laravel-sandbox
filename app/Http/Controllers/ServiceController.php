<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

/**
 * Here is where all magic happens.
 */
abstract class ServiceController extends Controller
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * $service Nome da Service para a Controller
     *
     * @var string
     */
    protected $service = null;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Returns the controller respective service provider by "guessing"
     *
     * @TODO - Find a better and leaner way to do it than messing around with strings
     *
     * @return Phalcony\Core\Service\ServiceAbstract
     */
    protected function getService()
    {
        if (is_null($this->service)) {
            $arr                  = explode('\\', get_class($this));
            $arr[count($arr) - 3] = 'Model';
            $arr[count($arr) - 2] = 'BusinessServiceProvider';
            $arr[count($arr) - 1] = str_replace('Controller', '', $arr[count($arr) - 1]);
            $this->service        = implode('\\', $arr);
            $this->service        = new $this->service($this->app);
        } else if (is_string($this->service)) {
            $this->service = new $this->service;
        }
        return $this->service;
    }

    /**
     * Default route to show that the controller is up and running on desired path
     * @Route("/", methods={"GET"} )
     */
    public function index($data = null)
    {
        return response()->json(
            array('msg' => 'OK')
        );
    }
}