<?php

namespace App\Model;

/**
 * Generic repository with generic queries to support all the
 * generic things a generic API should generically do.
 * Generally speaking, general stuff. XD
 */
class Repository extends BusinessServiceProvider
{
    /**
     * Nome da classe da Model deste Repository
     * @var string
     */
    protected $modelClass = null;

    /**
     * Instância da Model que está sendo manipulada pela Repository
     * @var null
     */
    protected $model = null;

    public function __construct(Model $model = null)
    {
        if ($model) {
            $this->model = $model;
        } else {

        }
    }

    /**
     * Define o nome da classe da Model
     *
     * @param [type] $modelClass [description]
     */
    public function setModelClass($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * Retorna ou cria automaticamente com base no nome da service, o nome da entidade raiz
     *
     * @return string
     */
    public function getRelatedClass($attr, $namespace, $sufix = '')
    {
        if (is_null($this->$attr)) {
            $arr                  = explode('\\', get_class($this));
            $arr[count($arr) - 2] = $namespace;
            $arr[count($arr) - 1] = str_replace(
                array('Service', 'Repository'),
                $sufix,
                array_pop($arr)
            );
            $this->$attr = implode('\\', $arr);
        }

        return $this->$attr;
    }

    /**
     * Obtém instância da Model desta service
     * @return \Multi\Core\Model;
     */
    public function getModel()
    {
        $this->getRelatedClass('modelClass', 'Model');

        if (!class_exists($this->modelClass)) {
            $this->model       = new Model;
            $modelClass        = $this->modelClass;
            $arr               = explode('\\', $modelClass);
            $modelAbsoluteName = array_pop($arr);
            $tableName         = \Phalcon\Text::uncamelize($modelAbsoluteName);
            $this->model->setTable($tableName);
        }

        return $this->model = ($this->model ? $this->model : new $this->modelClass);
    }

    /**
     * Retorna a model de acordo com os dados fornecidos
     *
     * @param  array $data [description]
     * @return Model       [description]
     */
    public function getModelInstance($data = array())
    {
        return (isset($data['id']) && $data['id']) ?
        $this->getBy('id', $data['id']) :
        $this->getModel();
    }

    // /**
    //  * obtém os filtros para pesquisa, tratados um a um
    //  *
    //  * @param  array $filters
    //  */
    // public function getSearchFilters($filters)
    // {
    //     $conditions = '';
    //     $and        = '';

    //     if (is_array($filters) && count($filters)) {
    //         foreach ($filters as $attr => $value) {
    //             $conditions .= $and . $attr . ' = ' . $value . '';
    //             $and = ' and ';
    //         }
    //     }

    //     return $conditions;
    // }

    // /**
    //  * Obtém listagem com base em filtro
    //  *
    //  * @param  integer $limit
    //  * @param  integer $offset
    //  * @param  array $filters
    //  * @param  string $sortFields [description]
    //  * @param  string $sortDirections [description]
    //  * @return array
    //  */
    // public function pagedSearch($limit, $offset, $filters = array(), $sortFields = 'id', $sortDirections = 'ASC')
    // {
    //     $conditions = $this->getSearchFilters($filters);

    //     $data = [];
    //     if ($conditions) {
    //         $data['conditions'] = $conditions;
    //     }

    //     if ($sortFields) {
    //         $data['order'] = $sortFields . ' ' . $sortDirections;
    //     }

    //     if ($conditions) {
    //         $data['limit'] = $limit;
    //     }

    //     if ($offset && $limit) {
    //         $data['offset'] = (($offset - 1) * $limit);
    //     }

    //     $model = $this->getModel();

    //     return $model->find($data);
    // }

    // /**
    //  * Contagem total com base nos filtros passados
    //  *
    //  * @return [type] [description]
    //  */
    // public function countGetAll($filters = array())
    // {
    //     $model = $this->getModel();

    //     $conditions = $this->getSearchFilters($filters);

    //     $data = [];
    //     if ($conditions) {
    //         $data['conditions'] = $conditions;
    //     }

    //     return count($model->find($data));
    // }

    /**
     * Obtém os dados da pessoa utilizando um atributo
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBy($attribute, $value, $model = null)
    {
        $model = $model ? $model : $this->getModelInstance();

        $models = $model->where($attribute, $value)->get();

        return $models;
    }

    /**
     * Persiste o modelo no banco de dados, de forma transacional
     *
     * @param  \Multi\Core\Model $model [description]
     * @param  [type] $data[description]
     * @return [type]        [description]
     * @throws \Exception
     */
    public function persistModel($model)
    {
        $this->errors = $model->save() ? null : $model->getMessages();

        if (count($this->errors)) {
            throw new ModelException;
        }

        return $model;

    }
}
