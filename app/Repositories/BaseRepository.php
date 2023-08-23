<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

// abstract class : structure for all Model classes
abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());  // set Model
    }

    abstract public function getModel();  // getModel to be defined

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        if ($result) return $result;
        
        return false;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->model->find($id);

        if ($result) {
            return $result->update($attributes); 
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->model->find($id);

        if ($result) {
            return $result->delete(); 
        }

        return false;
    }
}