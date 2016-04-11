<?php
/**
 * Created by PhpStorm.
 * User: sergey@slepokurov.com
 * Date: 10.04.2016
 * Time: 23:09
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use League\Flysystem\Exception;


/**
 * Class Repository
 */
abstract class Repository implements RepositoryInterface {

    /**
     * @var App
     */
    private $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    public function modelEmbed($embed) {
        return $embed == null ? $this->model : $this->with($embed);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @return Model
     */
    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $data) {
        return $this->model->firstOrCreate($data);
    }



    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute="id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }

    /**
     * @param $embed
     * @return mixed
     */
    public function with(array $embed) {
        return $this->model->with($embed);
    }

    /**
     * @param $id
     * @param array $columns
     * @param array $embed
     * @return mixed
     */
    public function find($id, $embed = null, $columns = array('*')) {
        return $this->modelEmbed($embed)->find($id, $columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = array('*')) {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function first($id, $attribute="id") {
        return $this->model->where($attribute, '=', $id)->first();
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }
}