<?php

namespace App\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }
    abstract public function getModel();
    
    public function setModel()
    {
        try {
            $this->model = app()->make(
                $this->getModel()
            );
        } catch(BindingResolutionException $e) {     
        }
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if($result){
            $result->delete();
            return $result;
        }
    }



}