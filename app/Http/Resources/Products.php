<?php

namespace App\Http\Resources;

use App\Models\Products as model;
use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'price_lid' => $this->price_lid,
            'cost_email' => $this->cost_email,
            'cost_sends' => $this->cost_sends,
            'approve' => $this->approve,
            'buyout' => $this->buyout,
            'created_at' => $this->created_at,
        ];
    }
}
