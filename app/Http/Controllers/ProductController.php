<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorySyncRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\TagCategorySyncRequest;
use App\Http\Requests\TagSyncRequest;
use App\Http\Resources\BrandResource as ResourcesBrandResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query('query');
        $category = $request->query('category');
        $builder = Product::with([
            'categories',
            'tags',
            'brand',
            "discounts" => function ($q) {
                $q->where('endAt', '>=', now())->where('startAt', '<=', now())
                    ->orderByDesc('created_at')
                    ->limit(1);
            }
        ]
        )
        // ->where('isAvailable',true)
        ->orderByRaw("CASE
            WHEN name LIKE '".$query."%'  THEN 0
            WHEN name LIKE '%".$query."%' THEN 1
            WHEN name LIKE '%".$query."' THEN 2
            WHEN nameAr LIKE '".$query."%' THEN 0
            WHEN nameAr LIKE '%".$query."%' THEN 1
            WHEN nameAr LIKE '%".$query."' THEN 2
            ELSE 3
        END")
        ->where(function ($q) use ($query) {
            $q->where("name","LIKE","%".$query."%")
            ->orWhere("nameAr","LIKE","%".$query."%")
            ->orWhere("description","LIKE","%".$query."%")
            ->orWhere("descriptionAr","LIKE","%".$query."%")
            ->orWhereHas('categories', fn($q) => $q->where("name","LIKE","%".$query."%"))
            ->orWhereHas('categories', fn($q) => $q->where("nameAr","LIKE","%".$query."%"))
            ->orWhereHas('categories', fn($q) => $q->where("description","LIKE","%".$query."%"))
            ->orWhereHas('categories', fn($q) => $q->where("descriptionAr","LIKE","%".$query."%"))
            ->orWhereHas('brand', fn($q) => $q->where("name","LIKE","%".$query."%"))
            ->orWhereHas('brand', fn($q) => $q->where("nameAr","LIKE","%".$query."%"))
            ->orWhereHas('brand', fn($q) => $q->where("description","LIKE","%".$query."%"))
            ->orWhereHas('brand', fn($q) => $q->where("descriptionAr","LIKE","%".$query."%"));
        });


        $brand = $request->query('brand');
        if ($brand) {
            $builder->where('brand_id',$brand);
        }
        $discount = $request->query('discount');
        if ($discount=="true") {
            $builder->whereHas('discounts', function ($q) {
                $q->where('startAt', '<=', now())
                    ->where('endAt', '>=', now());
            });
        }
        if ($category) {
            $builder->whereHas('categories', fn($q) => $q->where('id',$category));
        }
        $favorites = $request->query('favorites');
        if ($favorites) {
            $ids = explode(",",$favorites);
            $builder->whereIn('id',$ids);
        }


        $products = $builder->paginate(20)->withQueryString();
        $brands=$builder->groupBy('brand_id')->paginate(100);
        return response()->json([
            'products' => ProductResource::collection($products)->response()->getData(true),
            'brands' => ProductResource::collection($brands),
        ]);



    }

    public function index1(Request $request)
    {
        $query = $request->query('query');
        $category = $request->query('category');
        $barcode = $request->query('barcode');
        $builder = Product::with(['categories','tags','brand'])->where('isAvailable',true)
        ->orderByRaw("CASE
            WHEN name LIKE '".$query."%'  THEN 0
            WHEN name LIKE '%".$query."%' THEN 1
            WHEN name LIKE '%".$query."' THEN 2
            WHEN nameAr LIKE '".$query."%' THEN 0
            WHEN nameAr LIKE '%".$query."%' THEN 1
            WHEN nameAr LIKE '%".$query."' THEN 2
            ELSE 3
        END")
        ->where(function ($q) use ($query) {
            $q->where("name","LIKE","%".$query."%")
            ->orWhere("nameAr","LIKE","%".$query."%")
            ->orWhere("description","LIKE","%".$query."%")
            ->orWhere("descriptionAr","LIKE","%".$query."%")
            ->orWhereHas('categories', fn($q) => $q->where("name","LIKE","%".$query."%"))
            ->orWhereHas('categories', fn($q) => $q->where("nameAr","LIKE","%".$query."%"));
        });


        if ($category) {
            $builder->whereHas('categories', fn($q) => $q->whereId($category));
        }
        if($barcode){
            $builder->where('barcode',$barcode);
        }
        $brand = $request->query('brand');
        if ($brand) {
            $builder->where('brand_id',$brand);
        }
        $favorites = $request->query('favorites');
        if ($favorites) {
            $ids = explode(",",$favorites);
            $builder->whereIn('id',$ids);
        }
        $brands=Category::where("name","LIKE","%".$query."%")
        ->orWhere("nameAr","LIKE","%".$query."%")
        ->orWhereHas("products",fn($q)=>$q->where("name","LIKE","%".$query."%"))
        ->orWhereHas("products",fn($q)=>$q->where("nameAr","LIKE","%".$query."%"))
        ->orWhereHas("products",fn($q)=>$q->where("nameAr","LIKE","%".$query."%"))
        ;



        $products = $builder->paginate(20)->withQueryString();

        return ProductResource::collection($products);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function search(Request $request)
    {
        $query = $request->query('query');

        $categories = Category::where('name','LIKE',"%".$query."%")
        ->orWhere('nameA','LIKE',"%".$query."%")
        ->limit(10)->get();

        $brands = Brand::where('name','LIKE',"%".$query."%")
        ->orWhere('namAr','LIKE',"%".$query."%")
        ->limit(10)->get();

        $products = Product::where('name','LIKE',"%".$query."%")
        ->orWhere('namAr','LIKE',"%".$query."%")
        ->limit(10)->get();

        return response()->json([
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {

        $product = Product::create($request->except('categories','tags'));
        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);

        return new ProductResource($product->fresh()->load(["categories","tags"]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load(['categories','tags']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        // dd($request->all());

        if ($request->hasFile('img')) {
            $img = $request->file('img');

            $filename = time() . '.' . $img->extension();
            $image = Image::read($img);
            $image
            ->resize(200,200, function($constraint){
                $constraint->aspectRatio();
            })
            ->save(('storage/'.$filename));
            if($product->img != null)
            {
                $fn = basename($product->img);
                Storage::disk('public')->delete($fn);
            }
            $product->img = $filename;
        }



        $product->update($request->except('categories','tags','img'));
        // $product->categories()->sync($request->categories);
        // $product->tags()->sync($request->tags);

        $product->load(['categories','brand']);
        return new ProductResource($product);
    }

    /**
     * Update the product image.
     */
    public function uploadImage(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $imageName = time().'.'.$request->file('image')->extension();

        if($request->hasFile('image')){


            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::read($image);
            // Resize image
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('images/'.$filename));
        }
        $request->image->move(public_path('images'), $imageName);

        $product->img = asset('images/'.$imageName);
        $product->save();

        return response()->json(['status' => 'image updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['status' => 'deleted'],200);
    }


    public function syncCategories(Product $product, CategorySyncRequest $request)
    {
        $product->categories()->sync($request->categories);
        return response()->json(['status' => 'synced'],200);
    }

    public function syncTags(Product $product, TagSyncRequest $request)
    {
        $product->tags()->sync($request->tags);
        return response()->json(['status' => 'synced'],200);
    }

    public function sync(Product $product, TagCategorySyncRequest $request)
    {
        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);
        $product->load(['categories','tags']);
        return new ProductResource($product);
    }

}
