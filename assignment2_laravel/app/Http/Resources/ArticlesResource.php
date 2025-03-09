<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ArticleId' => $this->ArticleId,
            'Title' => $this->Title,
            'Body' => $this->Body,
            'CreatDate' => $this->CreatDate ? \Carbon\Carbon::parse($this->CreatDate)->format('F j, Y, g:i a') : null,
            'StartDate' => $this->StartDate ? \Carbon\Carbon::parse($this->StartDate)->format('F j, Y, g:i a') : null,
            'EndDate' => $this->EndDate ? \Carbon\Carbon::parse($this->EndDate)->format('F j, Y, g:i a') : null,
            'ContributorUsername' => $this->ContributorUsername,
            'created_at' => $this->created_at ? $this->created_at->format('F j, Y, g:i a') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('F j, Y, g:i a') : null,
        ];
    }
}
