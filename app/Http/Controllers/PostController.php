<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q -> orWhere('title',"like","%$keyword%")
                ->orWhere('description','like',"%$keyword%");
        })
        ->when(Auth::user()->role === 'author',fn($q)=>$q->where('user_id',Auth::id()))
        ->latest('id')
        ->with(['category','user'])
        ->paginate(7)->withQueryString();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50);
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        if ($request->hasFile('featured_image')) {
            $newN = uniqid() . "-featured_image." . $request->file('featured_image')->getClientOriginalName();
            $request->file('featured_image')->storeAs("public", $newN);
            $post->featured_image = $newN;
        }
        $post->save();

        //save post photos
        foreach($request->photos as $photo){
            //save storage
            $newN = uniqid()."_post-image_".$photo->extension();
            $photo->storeAs("public",$newN);
            
            //save db
            $photo = new Photo();
            $photo->post_id = $post->id;
            $photo->name = $newN;
            $photo->save();
        }
        return redirect()->route('post.index')->with('status', $request->title . 'is inserted successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if(Gate::denies('update',$post)){
            return abort(403);
        }
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50);
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        if ($request->hasFile('featured_image')) {
            //delete old image
            Storage::delete('public/'.$post->featured_image);
            //update
            $newN = uniqid() . "-featured_image." . $request->file('featured_image')->getClientOriginalName();
            $request->file('featured_image')->storeAs("public", $newN);
            $post->featured_image = $newN;
        }
        $post->update();

        //save post photos
        foreach($request->photos as $photo){
            //save storage
            $newN = uniqid()."_post-image_".$photo->extension();
            $photo->storeAs("public",$newN);
            
            //save db
            $photo = new Photo();
            $photo->post_id = $post->id;
            $photo->name = $newN;
            $photo->save();
        }
        return redirect()->route('post.index')->with('status', $request->title . 'is updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete',$post);
        if(isset($post->featured_image)){
            Storage::delete('public/'.$post->featured_image);
        }
        foreach($post->photos as $photo){
            
            Storage::delete('public/'.$photo->name);
            
            $photo->delete();
        }
        $post->delete();
        return redirect()->route('post.index')->with('status',  'delete successful');

    }
}
