<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'state' => $this->state,
          'amount' => $this->amount . ' kzt',
          'option' => $this->option,
          'description' => $this->description,
          'creation_date' => $this->getFormattedDate('creation_date'),
          'expiration_date' => $this->expiration_date,
          'merchant' => $this->merchant,
          'hook' => $this->hook,
        ];
    }
}
