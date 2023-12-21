<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDatailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'new_content'=>$this->new_content,
            'author'=>$this->author,
            'created_at'=>date_format($this->created_at,"Y-m-d H:i:s"),
            'writer'=>$this->whenLoaded('writer')
        ];
    }
}
