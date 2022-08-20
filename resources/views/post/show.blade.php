@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('post.index')}}">Post</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
</nav>
<div class="card">
    <div class="card-body">
        <h4>{{$post->title}}</h4>
        <hr>
        <div class="mb-3">
            <span class="badge bg-secondary p-1">
                <i class="bi bi-grid"></i>
                {{App\Models\Category::find($post->category_id)->title}}
            </span>
            <span class="badge bg-secondary p-1">
                <i class="bi bi-person"></i>
                {{App\Models\User::find($post->user_id)->name}}
            </span>
            <span class="badge bg-secondary p-1">
                <i class="bi bi-calendar"></i>
                {{$post->created_at->format('d m Y')}}
            </span>
            <span class="badge bg-secondary p-1">
                <i class="bi bi-alarm"></i>
                {{$post->created_at->format('g:m A')}}
            </span>
        </div>
        @isset($post->featured_image)
        <div>
        <img src="{{ asset('storage/'.$post->featured_image) }}" class="w-100" alt="">

        </div>
        @endisset
        <p>
            {{$post->description}}
        </p>
        <hr>
    <div class="">
        <a href="{{route('post.create')}}" class="btn btn-primary mr-2">Create</a>
        <a href="{{route('post.index')}}" class="btn btn-outline-primary">Post List</a>
    </div>
    </div>
</div>
@endsection