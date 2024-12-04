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
        if (!filter_var($this->img, FILTER_VALIDATE_URL)) {
            $this["img"] = env('APP_URL') . Storage::url($this->img);
        }

        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "nameAr"=>$this->nameAr,
            "description"=>$this->description,
            "descriptionAr"=>$this->descriptionAr,
            "price"=>(int)$this->price,
            "discount"=>$this->discount,
            "max"=>$this->max,
            "min"=>$this->min,
            "step"=>$this->step,
            "unit"=>$this->unit,
            "isInteger"=>$this->isInteger,
            "isFeatured"=>$this->isFeatured,
            "isAvailable"=>$this->isAvailable,
            "isSponsored"=>$this->isSponsored,
            "isNew"=>$this->isNew,
            "isRelated"=>$this->isRelated,
            "inputPrice"=>$this->inputPrice,
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
