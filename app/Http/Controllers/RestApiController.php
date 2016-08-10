<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class RestApiController extends Controller
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
     * Constantes para as informações de paginação
     */
    const PAGESIZE      = 'pageSize';
    const CURRENTPAGE   = 'currentPage';
    const FILTERS       = 'filtros';
    const SORTFIELDS    = 'sortFields';
    const SORTDIR       = 'sortDirections';
    const REPBUSINESS   = 'Business';
    const REPCONTROLLER = 'Controller';
    const BUSINESSCLASS = '\Phalcony\Core\Business\ModelBusiness';

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

    /**
     * @Route("/", methods={"POST"} )
     */
    public function search()
    {
        $dataPost = json_decode(json_encode($this->request->getJsonRawBody(), JSON_NUMERIC_CHECK), true);

        $dataPost[static::PAGESIZE]    = isset($dataPost[static::PAGESIZE]) ? $dataPost[static::PAGESIZE] : null;
        $dataPost[static::CURRENTPAGE] = isset($dataPost[static::CURRENTPAGE]) ? $dataPost[static::CURRENTPAGE] : null;
        $dataPost[static::FILTERS]     = isset($dataPost[static::FILTERS]) ? $dataPost[static::FILTERS] : null;
        $dataPost[static::SORTFIELDS]  = isset($dataPost[static::SORTFIELDS]) ? $dataPost[static::SORTFIELDS] : null;
        $dataPost[static::SORTDIR]     = isset($dataPost[static::SORTDIR]) ? $dataPost[static::SORTDIR] : null;

        $data = $this->getService()->getPagedSearch(
            $dataPost[static::PAGESIZE],
            $dataPost[static::CURRENTPAGE],
            $dataPost[static::FILTERS],
            $dataPost[static::SORTFIELDS],
            $dataPost[static::SORTDIR]

        );

        $response['list']              = $data->toArray();
        $response[static::CURRENTPAGE] = $dataPost[static::CURRENTPAGE];
        $response[static::PAGESIZE]    = $dataPost[static::PAGESIZE];
        $response['totalResults']      = $this->getService()->countGetAll($dataPost[static::FILTERS]);
        $response[static::SORTFIELDS]  = $dataPost[static::SORTFIELDS];
        $response[static::SORTDIR]     = $dataPost[static::SORTDIR];

        return response()->json($response);
    }

    /**
     * @Route("/", methods={"PUT"} )
     */
    public function put($data = null)
    {
        $data     = json_decode(json_encode($this->request->getJsonRawBody(), JSON_NUMERIC_CHECK), true);
        $response = $this->getService()->save($data)->toArray();
        return response()->json($response);
    }

    /**
     * @Route("/{id:[0-9]+}", methods={"GET"} )
     */
    public function show($id = null)
    {
        $data = $this->getService()->getBy('id', $id);
        return response()->json($data);
    }

    /**
     * @Route("/{id:[0-9]+}", methods={"DELETE"} )
     */
    public function delete($id)
    {
        $this->getService()->delete($id);
        return response()->json(['form' => 'deleted']);
    }
}
