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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $barcode = $request->query('barcode');
        $all = $request->query('all');
        $available=$request->query('available');
        $builder= Product::with([
            'categories',
            'tags',
            'brand',
            "discounts" => function ($q) {
                $q->where('endAt', '>=', now())->where('startAt', '<=', now())
                    ->orderByDesc('created_at')
                    ->limit(1);
            }
        ]
        );
        if($barcode){
           $builder->where('barcode',$barcode);

        }else{
            if(!$all){
                if($available){
                    if($available=="true"){
                        $builder->where('isAvailable',true);
                    }else{
                        $builder->where('isAvailable',false);
                    }
                }else{
                    $builder->where('isAvailable',true);
                }
            }
        $query = $request->query('query');
        $words = explode(' ', trim($query));

        $query1 = str_replace('%', '', trim($query));
        $query1 = str_replace(' ', '%', trim($query1));
        $category = $request->query('category');
        $builder
        ->orderByRaw("CASE
            WHEN name LIKE '".$query1."%'  THEN 0
            WHEN name LIKE '%".$query1."%' THEN 1
            WHEN name LIKE '%".$query1."' THEN 2
            WHEN nameAr LIKE '".$query1."%' THEN 0
            WHEN nameAr LIKE '%".$query1."%' THEN 1
            WHEN nameAr LIKE '%".$query1."' THEN 2
            ELSE 3
        END")
        ->where(function ($q) use ($query1) {
            $q->where("name","LIKE","%".$query1."%")
            ->orWhere("nameAr","LIKE","%".$query1."%")
            ->orWhere("description","LIKE","%".$query1."%")
            ->orWhere("descriptionAr","LIKE","%".$query1."%")
            ->orWhereHas('categories', fn($q) => $q->where("name","LIKE","%".$query1."%"))
            ->orWhereHas('categories', fn($q) => $q->where("nameAr","LIKE","%".$query1."%"))
            ->orWhereHas('categories', fn($q) => $q->where("description","LIKE","%".$query1."%"))
            ->orWhereHas('categories', fn($q) => $q->where("descriptionAr","LIKE","%".$query1."%"))
            ->orWhereHas('brand', fn($q) => $q->where("name","LIKE","%".$query1."%"))
            ->orWhereHas('brand', fn($q) => $q->where("nameAr","LIKE","%".$query1."%"))
            ->orWhereHas('brand', fn($q) => $q->where("description","LIKE","%".$query1."%"))
            ->orWhereHas('brand', fn($q) => $q->where("descriptionAr","LIKE","%".$query1."%"));
        })
        ->where(function ($q) use ($words) {
            foreach ($words as $word) {

                $q->where(function ($qq) use ($word){


                $qq->where("name","LIKE","%".$word."%")
                ->orWhere("nameAr","LIKE","%".$word."%")
                ->orWhere("description","LIKE","%".$word."%")
                ->orWhere("descriptionAr","LIKE","%".$word."%")
                ->orWhereHas('categories', fn($q) => $q->where("name","LIKE","%".$word."%"))
                ->orWhereHas('categories', fn($q) => $q->where("nameAr","LIKE","%".$word."%"))
                ->orWhereHas('categories', fn($q) => $q->where("description","LIKE","%".$word."%"))
                ->orWhereHas('categories', fn($q) => $q->where("descriptionAr","LIKE","%".$word."%"))
                ->orWhereHas('brand', fn($q) => $q->where("name","LIKE","%".$word."%"))
                ->orWhereHas('brand', fn($q) => $q->where("nameAr","LIKE","%".$word."%"))
                ->orWhereHas('brand', fn($q) => $q->where("description","LIKE","%".$word."%"))
                ->orWhereHas('brand', fn($q) => $q->where("descriptionAr","LIKE","%".$word."%"));
            }
        );
    }
}
)


;



        // for ($i=0; $i < 12; $i++) {
        //     shuffle($words);
        //     $qu= implode(' ',$words);
        //     $qu=str_replace(' ', '%', $qu);
        //     $builder->orWhere(function ($q) use ($qu) {
        //         $q->where("name","LIKE","%".$qu."%")
        //         ->orWhere("nameAr","LIKE","%".$qu."%")
        //         ->orWhere("description","LIKE","%".$qu."%")
        //         ->orWhere("descriptionAr","LIKE","%".$qu."%")
        //         ->orWhereHas('categories', fn($q) => $q->where("name","LIKE","%".$qu."%"))
        //         ->orWhereHas('categories', fn($q) => $q->where("nameAr","LIKE","%".$qu."%"))
        //         ->orWhereHas('categories', fn($q) => $q->where("description","LIKE","%".$qu."%"))
        //         ->orWhereHas('categories', fn($q) => $q->where("descriptionAr","LIKE","%".$qu."%"))
        //         ->orWhereHas('brand', fn($q) => $q->where("name","LIKE","%".$qu."%"))
        //         ->orWhereHas('brand', fn($q) => $q->where("nameAr","LIKE","%".$qu."%"))
        //         ->orWhereHas('brand', fn($q) => $q->where("description","LIKE","%".$qu."%"))
        //         ->orWhereHas('brand', fn($q) => $q->where("descriptionAr","LIKE","%".$qu."%"));
        //     });
        // }

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
        if(!$request->query('showAll')){

            $builder->whereNotNull('img')->where('img', '!=', '');

        }else{


                $imgFilter = $request->query('imageFilter');
                if ($imgFilter == '2') {
                    $builder->where(function ($q) {
                        $q->whereNull('img')->orWhere('img', '');
                    });
                }


        }


    }
        $f = clone $builder;
        $n = clone $builder;
        $br = clone $builder;
        $products = $builder
        // ->where(
        //     fn($q)=>$q->where('isFeatured',false)->orWhereNull('isFeatured')
        //     )
            ->paginate(20)->withQueryString();
        $brands=$br->groupBy('brand_id')->paginate(100);
        $featuredProducts = $f->where('isFeatured',true)->with(['categories','tags','brand'])->paginate(100);
        $newProducts = $n->where('isNew',true)->with(['categories','tags','brand'])->paginate(100);
        return response()->json([
            'products' => ProductResource::collection($products)->response()->getData(true),
            'brands' => ProductResource::collection($brands),
            'featuredProducts' => ProductResource::collection($featuredProducts),
            'newProducts' => ProductResource::collection($newProducts),
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
    $barcode = $request->barcode;
    if ($barcode) {
        // return response("no data",255);
        $existingProduct = Product::where('barcode', $barcode)->orWhere('name',$request->name)->first();
        if ($existingProduct) {
            // return $barcode;
            $existingProduct->update($request->except('categories', 'tags'));
            $existingProduct->categories()->sync($request->categories);
            // $existingProduct->tags()->sync($request->tags);
            return new ProductResource($existingProduct->fresh()->load(['categories', 'tags']));
        }
    }
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
            ->resize(500,500, function($constraint){
                $constraint->aspectRatio();
            })
            ->save(('storage/'.$filename));
            // if($product->img != null)
            // {
            //     $fn = basename($product->img);
            //     Storage::disk('public')->delete($fn);
            // }
            $product->img = $filename;
        }

        if($request->barcode != null)
        {
            Product::where('barcode',$request->barcode)->where('id','!=',$product->id)->update(['barcode'=>null]);
        }


        $product->update($request->except('categories','tags','img'));
        $product->categories()->sync($request->categories);
        // $product->tags()->sync($request->tags);

        $product->load(['categories','brand', "discounts" => function ($q) {
            $q->where('endAt', '>=', now())->where('startAt', '<=', now())
                ->orderByDesc('created_at')
                ->limit(1);
        }]);
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
