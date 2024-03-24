<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactRequest;
use App\Services\Contact\ContactService;


class ContactController extends Controller
{
    protected $ContactService;
    public function __construct(ContactService $ContactService)
    {
        $this->ContactService = $ContactService;
    }

    public function show($id)
    {
        return $this->ContactService->getContact($id);
    }
    public function update(ContactRequest $request, $id)
    {
        return $this->ContactService->updateContact($id, $request->all());
    }
}
