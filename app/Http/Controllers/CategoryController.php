<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
   
    public function index()
    {
        $categorie = Category::latest()->paginate(20);
        return view('admin.category.index',['categories' =>$categorie]);
    }

   
    public function create()
    {
        return view('admin.category.create');
    }

   
    public function store(Request $request)
    {
        // $categoryData = $request->validate([
        //     'name'  => 'required|unique:categories,name',
        //     // 'slug'  => ,
        // ]);
        $this->validate($request,[
            'name'  => 'required|unique:categories,name',
            // 'slug'  => ,
        ]);
        $category=Category::create([
            'name'  => $request->name,
            'description'  => $request->description,
            'slug'         =>Str::slug($request->name,'-'),
        ]);
        
        return redirect()->route('categories.index')->with('success', 'Category Added');
        
    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit',['category'=>$category]);
    }

    
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name'  => "required|unique:categories,name,".$category->id,
            // 'slug'  => ,
        ]);
       
        $category->name = $request->name;
        $category->slug = Str::slug($request->name,'-');
        $category->description = $request->description;
        $category->save();
        
        return redirect()->route('categories.index')->with('success', 'Category Updated');
    }

   
    public function destroy(Category $category)
    {
        if($category){
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category Deleted');
        }
        return back();
    }
}
