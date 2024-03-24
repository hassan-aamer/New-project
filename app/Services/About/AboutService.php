<?php

namespace App\Services\About;

use App\Http\Resources\About\AboutResource;
use App\Models\About;
use App\Traits\CRUD;
use App\Traits\ApiResponser;

class AboutService
{
    /**
     * Create a new class instance.
     */
    use CRUD, ApiResponser;

    protected $model;

    public function __construct()
    {
        $this->model = new About();
    }

    public function allAbout()
    {
        $About = $this->index($this->model, ['title', 'description']);
        return $About ? $this->success($About, 200, 'All About') : $this->error(null, 404, 'can not fetch data');
    }

    public function getAbout($id)
    {
        $About = $this->show($this->model, $id, ['title', 'description']);
        return $About ? $this->success($About, 200, 'One About') : $this->error(null, 404, 'can not fetch data');
    }

    public function createAbout($request)
    {
        $About = $this->store($this->model, $request);
        return $About ? $this->success(new AboutResource($About), 201, 'About created successfully') : $this->error(null, 404, 'can not create About');
    }

    public function updateAbout($id, $request)
    {
        $About = $this->update($this->model, $request, $id);
        return $About ? $this->success(new AboutResource($About), 200, 'About updated successfully') : $this->error(null, 404, 'can not update About');
    }

    public function deleteAbout($id)
    {
        $About = $this->destroy($this->model, $id);
        return $About ? $this->success(new AboutResource($About), 200, 'About deleted successfully') : $this->error(null, 404, 'can not delete About');
    }
}
