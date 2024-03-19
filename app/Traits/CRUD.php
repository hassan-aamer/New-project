<?php

namespace App\Traits;

trait CRUD
{
    public function index($model, $select)
    {
        return $model->select($select)->get();
    }

    public function indexWith($model, $select, $relations)
    {
        return $model->select($select)->with($relations)->get();
    }

    public function show($model, $id, $select)
    {
        return $model->select($select)->find($id);
    }

    public function showWith($model, $id, $select, $relations)
    {
        return $model->select($select)->with($relations)->find($id);
    }

    public function store($model, $request)
    {
        return $model->create($request);
    }

    public function update($model, $request, $id)
    {
        $data = $model->find($id);
        $data->update($request);
        return $data;
    }

    public function destroy($model, $id)
    {
        $data = $model->find($id);
        $data->delete();
        return $data;
    }
}
