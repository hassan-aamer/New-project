<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\AboutRequest;
use App\Services\About\AboutService;


class AboutController extends Controller
{
    protected $AboutService;
    public function __construct(AboutService $AboutService)
    {
        $this->AboutService = $AboutService;
    }

    public function show($id)
    {
        return $this->AboutService->getAbout($id);
    }
    public function update(AboutRequest $request, $id)
    {
        return $this->AboutService->updateAbout($id, $request->all());
    }
}
