@extends('master')
@section('title') post page @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            @isset($category)
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p>Filter By : {{ $category->title }}</p>
                <a href="{{ route('page.index') }}" class="btn  btn-outline-primary">See All</a>
            </div>
            @endisset
            @forelse($posts as $post)
            <div class="card my-4 p-2">
                <div class="card-body">
                    <h2>{{$post->title}}</h2>

                    <a href="{{route('page.postbycategory',$post->category->slug)}}">
                        <div class="badge bg-secondary">
                            {{$post->category->title}}
                        </div>
                    </a>

                    <hr>
                    <div class="my-2">
                        @forelse($post->photos as $photo)
                            <img src="{{asset('storage/500/'.$photo->name)}}" width="100" height="100" class="rounded ms-2" alt="">
                        @empty
                        @endforelse
                    </div>
                    <p class="my-3">{{$post->excerpt}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <i class="bi bi-person"></i><small>{{$post->user->name}}</small><br>
                            <i class="bi bi-clock"></i><small>{{$post->created_at->diffforHumans()}}</small>
                        </div>
                        <a href="{{route('page.detail',$post->slug)}}" class="btn btn-primary">See More</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="card">
                <div class="card-body">
                    <h1>There is no posts yet!</h1>
                    <a href="{{ route('page.index') }}" class="btn  btn-outline-primary">See All</a>
                </div>
            </div>
            @endforelse

        </div>
        <div class="col-12 col-lg-5">
            <div class="">
                <h2>Post Search</h2>
                <form url="{{route('page.index') }}" class="my-4">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" value="{{request('keyword')}}">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="">
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
        </div>
        <div class="">
            {{$posts->onEachSide(1)->links()}}
        </div>
    </div>
</div>
@endsection