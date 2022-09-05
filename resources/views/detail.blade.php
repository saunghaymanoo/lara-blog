@extends('master')
@section('title') post page @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card my-4 p-2">
                <div class="card-body">
                    <h2>{{$post->title}}</h2>

                    <a href="#">
                        <div class="badge bg-secondary">
                            {{$post->category->title}}
                        </div>
                    </a>

                    <hr>
                    <div class="mb-3">
                        @isset($post->photos->count)
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($post->photos as $key=>$photo)
                                @if($key==0)
                                <div class="carousel-item active">
                                    <a class="venobox curosel-img" data-gall="myGallery" href="{{asset('storage/'.$photo->name)}}">
                                        <img src="{{asset('storage/'.$photo->name)}}" class="curosel-img" alt="">
                                    </a>

                                </div>
                                @else
                                <div class="carousel-item">
                                    <a class="venobox curosel-img" data-gall="myGallery" href="{{asset('storage/'.$photo->name)}}">
                                        <img src="{{asset('storage/'.$photo->name)}}" class="curosel-img" alt="">
                                    </a>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        @endisset

                    </div>
                    <p class="my-3" style="white-space:pre-wrap;">{{$post->description}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <i class="bi bi-person"></i><small>{{$post->user->name}}</small><br>
                            <i class="bi bi-clock"></i><small>{{$post->created_at->diffforHumans()}}</small>
                        </div>
                        <a href="{{route('page.index')}}" class="btn btn-primary">Post List</a>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-12 col-lg-4">
            <div class="">
                <h2>Post Search</h2>
                <form url="{{route('page.index') }}" class="my-4">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" value="{{request('keyword')}}">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="my-3">
                <h2>Categories</h2>
                <div class="list-group">
                    @foreach($categories as $category)
                    <a 
                    class="list-group-item {{request()->url() === route('page.postbycategory',$category->slug) ? 'active' : ''}}" 
                    href="{{route('page.postbycategory',$category->slug)}}"
                    >
                        {{$category->title}}
                    </a>
                    @endforeach

                </div>
            </div>
            <div class="my-3">
                <h2>Recent Posts</h2>
                <div class="list-group">
                    @foreach($recentPosts as $post)
                    <a 
                    class="list-group-item {{request()->url() === route('page.detail',$post->slug) ? 'active' : ''}}" 
                    href="{{route('page.detail',$post->slug)}}"
                    >
                        {{$post->title}}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection