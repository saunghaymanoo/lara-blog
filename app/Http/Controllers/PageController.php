<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade as PDF;


class PageController extends Controller
{
    public function index(){
        $posts = Post::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q -> orWhere('title',"like","%$keyword%")
                ->orWhere('description','like',"%$keyword%");
        })
        ->latest('id')
        ->with(['category','user'])
        ->paginate(7)->withQueryString();
        return view('index',compact('posts'));
    }
    public function detail($slug){
        $post = Post::where('slug',$slug)->with(['user','category','photos'])->first();
        $recentPosts = Post::latest('id')->limit(5)->get();
        return view('detail',compact('post','recentPosts'));
    }
    public function postByCategory(Category $category){
        $posts = Post::where(function ($q){
            $q->when(request('keyword'),function($q){
                $keyword = request('keyword');
                $q->orWhere("title","like","%$keyword%")
                    ->orWhere("description","like","%$keyword%");
            });
        })
        ->where("category_id",$category->id)
        ->latest("id")
        ->with(['user','category'])
        ->paginate(10)
        ->withQueryString();

    return view('index',compact('posts','category'));
    }
    public function pdfDownload($slug){
        $post = Post::where('slug',$slug)->firstOrFail();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML("<h1>$post->title</h1><div>$post->description</div>");
        return $pdf->stream();
    }
}