<?php

namespace App\Http\Resources\Contact;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'email' => $this->email,
            'url_facebook' => $this->url_facebook,
            'url_instagram' => $this->url_instagram,
            'url_twitter' => $this->url_twitter,
            'url_youtube' => $this->url_youtube,
            'location' => $this->location,
        ];
    }
}
