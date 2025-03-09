<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'registrationDate' => $this->registrationDate ? \Carbon\Carbon::parse($this->registrationDate)->format('F j, Y, g:i a') : null,
            'isApproved' => $this->isApproved,
            'role' => $this->role,
            'created_at' => $this->created_at ? $this->created_at->format('F j, Y, g:i a') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('F j, Y, g:i a') : null,
        ];
    }
}
