<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Service extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->servicename,
            'details' => $this->details,
            'mdaid' => $this->mda_id,
            'mdaname' => $this->mda->name,
            'status' => $this->status,
            'hide' => $this->hide
        ];
    }
}
