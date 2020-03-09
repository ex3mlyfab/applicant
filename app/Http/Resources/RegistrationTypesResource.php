<?php

namespace App\Http\Resources;

use App\Models\Charge;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationTypesResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'max_enrollment' => $this->max_enrollment,
            'note' => $this->note,
            'charge' => Charge::find($this->charge_id),
        ];
    }
}
