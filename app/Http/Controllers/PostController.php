<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
   
    public function index()
    {
        $posts = Post::latest()->with('user')->paginate(15);
        return view('admin.post.index',['posts'=>$posts]);
    }

    
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create',['categories'=>$categories,'tags'=>$tags]);
    }

  
    public function store(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' =>'required|unique:posts,title',
            'image' =>'file|mimes:jpg,jpeg,png,gif',
            'description' =>'required',
            'category' =>'required',
            'tag' =>'required',
        ]);
      
        

           

        // dd($post);
         
         
        /*if($file = $request->file('image')){
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('post-image',$file,$filename);
        }
        else{
            $path = "default.jpg";
        }*/
        $slug =  $post->slug = Str::slug($request->title);
        if($file = $request->file('image')){
           
            $filename = time().'_'.$slug .'.'.$request->file('image')->getClientOriginalExtension();
            
            if(!Storage::disk('public')->exists('post-image')){
                Storage::disk('public')->makeDirectory('post-image');
            }
            Storage::disk('public')->putFileAs('post-image',$file,$filename);
        }
        else{
            $filename = 'default.jpg';
        }

        $categories=Category::all();
        $post->title = $request->title;
         $post->slug = $slug;
         $post->description = $request->description;
         $post->image = $filename;
         $post->published_at = Carbon::now();
         $post->user_id = auth()->user()->id;
         $post->save();
        // $post = Post::create([
        //     'title' =>$request->title,
        //     'slug'  =>Str::slug($request->title,'-'),
        //     'image' => $path,
        //     'description' =>$request->description,
        //     'published_at'  =>Carbon::now(),
        //     'user_id'   => auth()->user()->id,
        // ]);
        
        /*if($file = $request->file('image')){
            // $filename = Time().'_'.'post_image'.'_'.$request->file('image')->getClientOriginalExtension();
            // dd($filename);
            // $path = $file->storeAs('photos',$filename);
            // // $path = $file->store($filename);
            // // dd($path);
            // $post->image = $path;
            // $post->save();
            // // $path = $file->store('photos');
            // $storage = Storage::disk('local')->putFileAs('photos',$path,$file->guessClientExtension());
            // dd($storage);

            $filename = time().'_'.$post->slug .'.'.$request->file('image')->getClientOriginalExtension();
            //dd($filename);
            //$path = $file->storeAs('photos',$filename);
            $path = Storage::disk('public')->putFileAs('post-image',$file,$filename); //public storage
            //$storage = Storage::disk('local')->putFileAs('photos',$file,$filename); //local storage
            //dd($storage);
            //dd(Storage::url($storage));
            //dd(Storage::disk('local')->url($storage));
            $post->image = $path;
            $post->save();

           
            
        }*/
        $categories = $request->category;
        $tags = $request->tag;
        $post->categories()->sync($categories);
        $post->tags()->sync($tags);
        return redirect()->back()->with('success','Post has been added');


        // return redirect()->back()->with('success', 'Post has been added');
    }

  
    public function show(Post $post)
    {
        //
    }

 
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit',['post'=>$post, 'categories' =>$categories,'tags'=>$tags]);
    }

    
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' =>"required|unique:posts,title," .$post->id,
            'image' =>'file|mimes:jpg,jpeg,png,gif',
            'description' =>'required',
            'category' =>'required',
            'tag' =>'required',
        ]);
        // $post = Post::update([
        //     'title' =>$request->title,
        //     'slug'  =>Str::slug($request->title,'-'),
        //     'image' => 'image,jpg',
        //     'description' =>$request->description,
        //     'published_at'  =>Carbon::now(),
        //     'user_id'   => auth()->user()->id,
        // ]);

        /*if($file = $request->file('image')){
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('post-image',$file,$filename);
        }*/

        if($file = $request->file('image')){
           
            $filename = time().'_'.$post->slug .'.'.$request->file('image')->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('post-image')){
                Storage::disk('public')->makeDirectory('post-image');
            }
           
            Storage::disk('public')->putFileAs('post-image',$file,$filename);
        }
        else{
            $filename = 'default.jpg';
        }
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        if($file = $request->file('image')){
            if(Storage::disk('public')->exists('post-image/'.$post->image)){
                Storage::disk('public')->delete('post-image/'.$post->image);
            }
            $post->image = $filename;
        }
        
        $post->published_at = Carbon::now();
        $post->user_id = auth()->user()->id;
        $post->save();
        $categories = $request->category;
        $tags = $request->tag;
        $post->categories()->detach();
        $post->tags()->detach();
        $post->categories()->sync($categories);
        $post->tags()->sync($tags);
        return redirect()->back()->with('success','Post has been updated');
    }

   
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post-image/'.$post->image)){
            Storage::disk('public')->delete('post-image/'.$post->image);
        }
        if($post)
        {
            $post->delete();
            $post->categories()->detach();
            $post->tags()->detach();
            return redirect()->back()->with('success','Post was deleted!');
        }
    }
}