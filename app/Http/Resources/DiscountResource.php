<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            "description"=>$this->description,
            "percent"=>$this->percent,
            "amount"=>$this->amount,
            "startAt"=>floor(Carbon::parse($this->startAt)->getPreciseTimestamp(3)),
            "endAt"=>floor(Carbon::parse($this->endAt)->getPreciseTimestamp(3)),
        ];
    }
}
