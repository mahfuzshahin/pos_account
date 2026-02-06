<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'date'         => $this->date,
            'sell'         => $this->sell,
            'market'       => $this->market,
            'visacard'     => $this->visacard,
            'snacks'       => $this->snacks,
            'drivar_bill'  => $this->drivar_bill,
            'others'       => $this->others,

            // relation
            'shop' => new ShopResource($this->whenLoaded('shop')),

            'created_by'   => $this->created_by,
            'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
