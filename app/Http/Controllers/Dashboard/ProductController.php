<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::get();
        $products =  Product::when($request->search,function ($q) use ($request){

            return $q->whereTranslationLike('name' , '%' . $request->search . '%');

        })->when($request->category_id , function ($q) use ($request) {
            return $q->where('category_id',$request->category_id);
        })->latest()->paginate(10);
        return view('dashboard.products.index' , compact('products' , 'categories'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('dashboard.products.create' , compact('categories'));

    }


    public function store(Request $request)
    {

        $requestArray = $request->except('image');
        if ($request->image) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('images/products/' . $request->image->hashName()));
            $requestArray = ['image' =>  $request->image->hashName() ]+ $request->all();
        }
        $rules = [
            'category_id'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required',
        ];

        foreach (Config('translatable.locales') as $locle){

            $rules += [$locle . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locle . '.description' => 'required'];

        }

        $request->validate($rules);
    //        dd($requestArray);
        Product::create($requestArray);
        return redirect()->route('dashboard.products.index');
    }

    public function edit($id)
    {
        $categories = Category::get();
        $product = Product::findOrfail($id);
        return view('dashboard.products.edit' , compact('product' , 'categories'));

    }


    public function update(Request $request, Product $product)
    {
        $requestArray = $request->except( 'image');

        $rules = [
            'category_id'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required',
        ];

        foreach (Config('translatable.locales') as $locle){

            $rules += [$locle . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locle . '.description' => 'required'];

        }

        $request->validate($rules);

        if ($request->image) ;
        {
            if ($request->image != 'default.png') {

                unlink('images/products/' . $product->image);

            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('images/products/' . $request->image->hashName()));

            $requestArray['image'] = $request->image->hashName();
        }
        $product->update($requestArray);

        return redirect()->route('dashboard.products.index');

    }


    public function destroy(Product $product)
    {

        unlink('images/products/' . $product->image);
        $product->delete();
        return redirect()->route('dashboard.products.index');

    }

}
