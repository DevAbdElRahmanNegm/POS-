<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
       $categories =  Category::when($request->search,function ($q) use ($request){
            return $q->whereTranslationLike('name' , '%' .$request->search.'%');

       })->latest()->paginate(10);
       return view('dashboard.categories.index' , compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');

    }


    public function store(Request $request)
    {
        $rules = [];

        foreach (Config('translatable.locales') as $locle){

            $rules += [$locle . '.name' => 'required'];
            $rules += [$locle . '.name' => [Rule::unique('category_translations')]];

        }

        $request->validate($rules);
        Category::create($request->except('_token'));
        return redirect()->route('dashboard.categories.index');
    }


    public function edit($id)
    {
        $category = Category::findOrfail($id);
        return view('dashboard.categories.edit' , compact('category'));

    }

    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (Config('translatable.locales') as $locle){

            $rules += [$locle . '.name' => ['required',
                Rule::unique('category_translations' , 'name')
                    ->ignore($category['id'] , 'category_id')]];

        }

        $request->validate($rules);

        $category->update($request->all());

        return redirect()->route('dashboard.categories.index');

    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index');

    }
}
