@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('post.index')}}">Post</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Post</li>
  </ol>
</nav>
<div class="card">
  <div class="card-body">
    <h4>Create New Post</h4>
    <hr>
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Post Title</label>
        <input type="text"
          class="form-control @error('title') is-invalid @enderror"
          name="title" id="title"
           value="{{old('title')}}">
        @error('title')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="category" class="form-label">Post Category</label>
        <select type="text" class="form-control @error('category') is-invalid @enderror" name="category" id="category">
          @foreach(\App\Models\Category::all() as $c)
          <option 
          value="{{$c->id}}"
          {{$c->id == old('category')?'selected':''}}
          >
            {{$c->title}}
          </option>
          @endforeach
        </select>
        @error('category')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Post Description</label>
        <textarea type="text" class="form-control @error('description') is-invalid @enderror" rows="10" name="description" id="description">
        {{old('description')}}
        </textarea>
        @error('description')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="d-flex justify-content-between">
        <div class="mb-3">
          <label for="featured_image" class="form-label">Post Featured Image</label>
          <input
           type="file" 
           class="form-control @error('featured_image') is-invalid @enderror" 
           name="featured_image" id="featured_image" 
           value="{{old('featured_image')}}">
          @error('featured_image')
          <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>
        <button class="btn btn-lg btn-primary">Create Post</button>
      </div>
    </form>
  </div>
</div>
@endsection