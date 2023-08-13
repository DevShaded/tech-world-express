<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User\UserInformation */
class UserInformationResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company_name' => $this->company_name,
            'address' => $this->address,
            'address2' => $this->address2,
            'city' => $this->city,
            'state_province' => $this->state_province,
            'zip_postal_code' => $this->zip_postal_code,
            'phone' => $this->phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user'),
            'country_id' => $this->country_id,
            'country' => $this->whenLoaded('country'),
        ];
    }
}
