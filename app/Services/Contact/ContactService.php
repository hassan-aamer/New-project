<?php

namespace App\Services\Contact;

use App\Models\Contact;
use App\Traits\CRUD;
use App\Traits\ApiResponser;

class ContactService
{
    /**
     * Create a new class instance.
     */
    use CRUD, ApiResponser;

    protected $model;

    public function __construct()
    {
        $this->model = new Contact();
    }

    public function allContact()
    {
        $Contact = $this->index($this->model, ['phone', 'email', 'url_facebook', 'url_instagram','url_twitter','url_youtube','location']);
        return $Contact ? $this->success($Contact, 200, 'All Contact') : $this->error(null, 404, 'can not fetch data');
    }

    public function getContact($id)
    {
        $Contact = $this->show($this->model, $id, ['phone', 'email', 'url_facebook', 'url_instagram','url_twitter','url_youtube','location']);
        return $Contact ? $this->success($Contact, 200, 'One Contact') : $this->error(null, 404, 'can not fetch data');
    }

    public function createContact($request)
    {
        $Contact = $this->store($this->model, $request);
        return $Contact ? $this->success($Contact, 201, 'Contact created successfully') : $this->error(null, 404, 'can not create Contact');
    }

    public function updateContact($id, $request)
    {
        $Contact = $this->update($this->model, $request, $id);
        return $Contact ? $this->success($Contact, 200, 'Contact updated successfully') : $this->error(null, 404, 'can not update Contact');
    }

    public function deleteContact($id)
    {
        $Contact = $this->destroy($this->model, $id);
        return $Contact ? $this->success($Contact, 200, 'Contact deleted successfully') : $this->error(null, 404, 'can not delete Contact');
    }
}
