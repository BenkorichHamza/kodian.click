<?php

namespace App\Http\Resources;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this["img"] && !filter_var($this->img, FILTER_VALIDATE_URL)) {
            $this["img"] = env('APP_URL') . Storage::url($this->img);
        }

        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "nameAr"=>$this->nameAr,
            "description"=>$this->description,
            "descriptionAr"=>$this->descriptionAr,
            "price"=>(int)$this->price,
            "discount"=>(int)$this->discount,
            "max"=>(double)$this->max,
            "min"=>(double)$this->min,
            "step"=>$this->step,
            "unit"=>$this->unit,
            "isInteger"=>(int)$this->isInteger,
            "isFeatured"=>(int)$this->isFeatured,
            "isAvailable"=>(int)$this->isAvailable,
            "isSponsored"=>(int)$this->isSponsored,
            "isNew"=>(int)$this->isNew,
            "isRelated"=>(int)$this->isRelated,
            "inputPrice"=>(int)$this->inputPrice,
            "img"=>$this->img,
            "code"=>$this->code,
            "barcode"=>$this->barcode,
            // "barcodes"=>BarcodeResource::collection($this->barcodes),
            "discounts"=>DiscountResource::collection($this->discounts),
            "categories"=>CategoryResource::collection($this->whenLoaded('categories')),
            "tags"=>CategoryResource::collection($this->whenLoaded('tags')),
            "brand"=>new BrandResource($this->whenLoaded('brand')),
        ];
    }
}
