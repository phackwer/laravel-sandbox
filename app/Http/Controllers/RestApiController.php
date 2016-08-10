<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Here is where all magic happens.
 */
abstract class RestApiController extends ServiceController
{
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

    /**
     * Get an Entity data
     *
     * @Route("/{id:[0-9]+}", methods={"GET"} )
     */
    public function show($id = null)
    {
        $data = $this->getService()->getBy('id', $id);
        return response()->json($data);
    }

    /**
     * Persist an Entity data
     *
     * @Route("/", methods={"PUT"} )
     */
    public function put($data = null)
    {
        $data     = json_decode(json_encode($this->request->getJsonRawBody(), JSON_NUMERIC_CHECK), true);
        $response = $this->getService()->save($data)->toArray();
        return response()->json($response);
    }

    /**
     * Remove an Entity from database
     *
     * @Route("/{id:[0-9]+}", methods={"DELETE"} )
     */
    public function delete($id)
    {
        $this->getService()->delete($id);
        return response()->json(['form' => 'deleted']);
    }

    /**
     * Search and returns matching entities with a paged and ordered resultset
     *
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
}
