<?php

namespace App\Http\Resources\User;

use App\Http\Resources\User\Billing\UserBillingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'userBilling' => new UserBillingResource($this->whenLoaded('userBilling')),
            'userInformation' => new UserInformationResource($this->whenLoaded('userInformation')),
        ];
    }
}
