<?php

namespace App\Utils;

use App\Traits\PaginateModels;
use App\Traits\ValidateRequests;
use Illuminate\Database\Eloquent\Model;

abstract class BaseCrudRepository
{
    use ValidateRequests, PaginateModels;

    /**
     *  The model class to manage services
     */
    protected Model $modelClass;
    protected string $modelClassName;

    /**
     *  Validation rules for creation
     */
    protected array $creationRules = [];

    /**
     * Validation rules for update
     */
    protected array $updateRules = [];

    /**
     * Summary of defaultWith
     * @var array
     * @return mixed array
     */
    protected array $defaultWith = [];

    // public function __construct(){
    //     $this->modelClass = $this->resolveModel();
    // }

    // private function resolveModel(): Model {
    //     // Get the repository or service class name
    //     $className = get_class($this);

    //     // remove suffix
    //     // $baseName = preg_replace('/(Repository|Service)$/', '', class_basename($className));
    //     $baseName = $this->modelClassName ;
    
    //     $modelClass = 'App\\Models\\' . $baseName;

    //     if(!class_exists($className)) throw new \RuntimeException("Model {$modelClass} not exists.");

    //     return new $modelClass;
    // }

    public function paginateData(int $perPage = 10, array $query = [])
    {
        return $this->getPaginatedResults($this->modelClassName, $perPage, $query);
    }

    /**
     * get all model data
     * @return mixed array
     */
    public function getAll()
    {
        return $this->modelClass::with(array_merge($this->defaultWith))->get();
    }
    /**
     * get specific model by id
     * @param int $id
     * @param array $with
     * @return  mixed array
     */
    public function getById(int $id, array $with = [])
    {
        return $this->modelClassName::with(array_merge($this->defaultWith, $with))->findOrFail($id);
    }

    /**
     * creat a model
     * @param array $data
     * @return static::$modelClass
     */
    public function createData(array $data)
    {
        $validated = $this->validtateData($data, $this->creationRules);
        $model = new $this->modelClassName;
        $model->fill($validated)->save();
        return $model->fresh();
    }

    public function updateData(int $id, array $data, array $with = [])
    {
        $validated = $this->validtateData($data, $this->updateRules);

        $model = $this->getById($id, $with);
        
        $model->update($validated);
        return $model->fresh();
    }

    /**
     * delete model
     * @param int $id
     * @return bool
     */
    public function deleteData(int $id): bool
    {
        $model = $this->getById($id);
        return $model->delete();
    }
}
