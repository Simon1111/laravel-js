<?php

namespace App\Http\Resources;

use App\Models\Comments as model;
use Illuminate\Http\Resources\Json\JsonResource;

class Comments extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'url' => $this->url,
            'count' => $this->count,
            'comments' => Comments::select(['text'])->where('url', $this->url)->get()
        ];
    }
}
