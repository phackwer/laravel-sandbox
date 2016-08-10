<?php

namespace App\Model;

/**
 *  Business service provider specially tailored to handle Model Entities
 */
class ModelBusinessServiceProvider extends BusinessServiceProvider
{

    /**
     * Nome da classe da Repository desta Service
     * @var string
     */
    protected $repositoryClass = null;

    /**
     * Instância da Repository que está sendo manipulada pela Business
     * @var \Model\Core\Repository
     */
    protected $repository = null;

    /**
     * Nome da classe da Model desta Service
     * @var string
     */
    protected $modelClass = null;

    /**
     * Instância da Model que está sendo manipulada pela Business
     * @var \Phalcony\Core\Model
     */
    protected $model = null;

    /**
     * Service de Business de Validação dos dados do Modelo
     *
     * @var null
     */
    protected $modelValidatorClass = null;

    /**
     * Service de Business de verificação de regras de negócios
     *
     * @var null
     */
    protected $ruleValidatorClass = null;

    /**
     * Define o nome da classe da Repository
     *
     * @param [type] $repositoryClass [description]
     */
    public function setRepositoryClass($repositoryClass)
    {
        $this->
repositoryClass = $repositoryClass;
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
            $arr = explode('\\', get_class($this));
            $arr[count($arr) - 2] = $namespace;
            $arr[count($arr) - 1] = str_replace(
                array('Service', 'Business'),
                $sufix,
                array_pop($arr)
            );
            $this->$attr = implode('\\', $arr);
        }

        return $this->$attr;
    }

    /**
     * Retorna ou cria automaticamente com base no nome da service, o nome da entidade raiz
     *
     * @return string
     */
    public function getModelValidator()
    {
        $this->getRelatedClass('modelValidatorClass', 'Business\\Validation', 'ModelValidator');
        return class_exists($this->modelValidatorClass) ? new $this->modelValidatorClass : null;
    }

    /**
     * Retorna ou cria automaticamente com base no nome da service, o nome da entidade raiz
     *
     * @return string
     */
    public function getRuleValidator()
    {
        $this->getRelatedClass('ruleValidatorClass', 'Business\\Validation', 'RuleValidator');
        return class_exists($this->ruleValidatorClass) ? new $this->ruleValidatorClass : null;
    }

    /**
     * Obtém instância da Model desta service
     * @return \Phalcony\Core\Model;
     */
    public function getModel()
    {
        $this->getRelatedClass('modelClass', 'Model');

        if (!class_exists($this->modelClass)) {
            $this->model = new Model;
            $modelClass = $this->modelClass;
            $arr = explode('\\', $modelClass);
            $modelAbsoluteName = array_pop($arr);
            $tableName = \Phalcon\Text::uncamelize($modelAbsoluteName);
            $this->model->setDataSource($tableName);
        }

        return $this->model = ($this->model ? $this->model : new $this->modelClass);
    }

    /**
     * Obtém instância da Repository desta service
     * @return \Phalcony\Core\Repository;
     */
    public function getRepository($model = null)
    {
        $this->getRelatedClass('repositoryClass', 'Repository');

        if (!class_exists($this->repositoryClass)) {
            $this->repository = new Repository($model);
            $this->repository->setModelClass($this->getRelatedClass('modelClass', 'Model'));
        }

        $this->repository = ($this->repository ? $this->repository : new $this->repositoryClass($model));

        if (!$this->repository->getApp()) {
            $this->repository->setApp($this->app);
        }

        return $this->repository;
    }

    /**
     * Obtém listagem com base em filtro
     *
     * @param  integer $limit
     * @param  integer $offset
     * @param  array $filters
     * @param  string $sortFields [description]
     * @param  string $sortDirections [description]
     * @return array
     */
    public function getAll($limit, $offset, $filters = array(), $sortFields = 'id', $sortDirections = 'ASC')
    {
        $repo = $this->getRepository();
        return $repo->find($limit, $offset, $filters, $sortFields, $sortDirections);
    }

    /**
     * Contagem total com base nos filtros passados
     *
     * @return [type] [description]
     */
    public function countGetAll($filtros = array())
    {
        $repo = $this->getRepository();
        return $repo->countGetAll($filtros);
    }

    /**
     * Obtém os dados da pessoa utilizando um atributo
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBy($attribute, $value, $model = null)
    {
        $repo = $this->getRepository();
        return $repo->getBy($attribute, $value, $model);
    }

    /**
     * Retorna a model de acordo com os dados fornecidos
     *
     * @param  array $data [description]
     * @return Model       [description]
     */
    public function getModelInstance($data = array())
    {
        $this->model = (isset($data['id']) && $data['id']) ?
            $this->getBy('id', $data['id']) :
            $this->getModel();
        return $this->model;
    }

    /**
     * Preenche a model de acordo com os dados fornecidos
     *
     * @param  [type] $model [description]
     * @param  [type] $data  [description]
     * @return [type]        [description]
     */
    public function fillModel($model, $data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $model->$key = $value;
            }
        }
    }

    /**
     * Persiste os dados da entidade, tanto para insert quanto para update
     *
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function save($data)
    {
        $this->getModelInstance($data);

        $this->fillModel($this->model, $data);

        $this->getModelValidator() ? $this->getModelValidator()->saveValidation($this->model) : null;
        $this->getRuleValidator() ? $this->getRuleValidator()->saveValidation($this->model) : null;

        $this->getRepository()->persistModel($this->model, $data);

        return $this->getModel();
    }

    /**
     * Exclusão física dos dados da entidade do banco
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $model = $this->getBy('id', $id);

        $this->getModelValidator() ? $this->getModelValidator()->deleteValidation($model) : null;
        $this->getRuleValidator() ? $this->getRuleValidator()->deleteValidation($model) : null;

        if (!$this->getRepository($model)->delete()) {
            return false;
        }

        return true;
    }
}
