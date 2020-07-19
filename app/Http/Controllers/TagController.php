<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
   
    public function index()
    {
        $tags = Tag::latest()->paginate(20);
        return view('admin.tag.index',['tags'=>$tags]);
    }

  
    public function create()
    {
        return view('admin.tag.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required| unique:tags,name'
        ]);
        $tags = Tag::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name,'-'),
            'description' =>$request->description
        ]);
        return redirect()->route('tags.index')->with('success','Tag added successfully');

    }

  
    public function show(Tag $tag)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit',['tag'=>$tag]);
    }

   
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request,[
            'name'  => "required| unique:tags,name,". $tag->id
        ]);

        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name,'-');
        $tag->description = $request->description;
        $tag->save();

        return redirect()->route('tags.index')->with('success','Tag has beed updated');
    }

    
    public function destroy(Tag $tag)
    {
        if($tag){
            $tag->delete();
            return redirect()->route('tags.index')->with('success','Tag has beed deleted');
        }
        return redirect()->back();
    }
}
