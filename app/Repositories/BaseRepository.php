<?php

namespace App\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements IRepository
{
    protected $model;

    public function __construct(App $app)
    {
        $this->setModel($app);
    }

    //Get model name
    abstract public function model();

    //Set model name
    public function setModel(App $app)
    {
        $this->model = $app->make($this->model());
    }

    //Check methods
    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            return $this->model->{$name}(...$arguments);
        }
    }

    //Find query
    public function find($id, $with = [])
    {
        return $this->model->where($this->model->getKeyName(), $id)->with($with)->firstOrFail();
    }

    //Make pagination
    public function paginate($with = [])
    {
        $query = $this->model->query();
        $query->with($with);

        $data = $query->paginate();
        return $data;
    }

    //Get all records
    public function get($with = [])
    {
        $query = $this->model->query();
        $query->with($with);
        $data = $query->get();
        return $data;
    }

    //Create new record
    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    //Update record
    public function update($id, $data)
    {
        return $this->model->where($this->getKeyName(), $id)->update($data);
    }

    //Delete record
    public function destroy($id)
    {
        $record = $this->find($id);

        return $this->model->where($this->getKeyName(), $id)->delete();
    }
}
