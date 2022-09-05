@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('post.index')}}">Post</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
  </ol>
</nav>
<div class="card">
  <div class="card-body">
    <h4>Edit Post</h4>
    <hr>
    @if(session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
    @endif
    <form action="{{route('post.update',$post->id)}}" method="post" id="postUpdateForm" enctype="multipart/form-data">
      @csrf
      @method('put')
    </form>
      <div class="mb-3">
        <label for="title" class="form-label">Post Title</label>
        <input 
          form="postUpdateForm"
          type="text"
          class="form-control @error('title') is-invalid @enderror"
          name="title" id="title"
          value="{{old('title',$post->title)}}">
        @error('title')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="category" class="form-label">Post Category</label>
        <select type="text" class="form-control @error('category') is-invalid @enderror" name="category" id="category" form="postUpdateForm">
          @foreach($categories as $c)
          <option 
          value="{{$c->id}}"
          {{$c->id == old('category',$post->category_id)?'selected':''}}
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
        <div class="mb-2 d-flex position-relative">
            @foreach($post->photos as $photo)
              
              <img src="{{asset('storage/'.$photo->name)}}" height="100" width="100" class="rounded" alt="">
        
              <form action="{{route('photo.destroy',$photo->id)}}" method="post" class="d-inline-block">
              @csrf
              @method('delete')
              <button class="btn btn-outline-danger btn-sm position-absolute bottom-0 left-0 z-20 me-2">
                <i class="bi bi-trash"></i>
              </button>
            </form>
            
           
            @endforeach
        </div>
        <div>
          <label for="photos" class="form-label">Post Photos</label>
          <input
            form="postUpdateForm"
           type="file"
           class="form-control @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror" 
           name="photos[]" multiple 
           id="photos" 
           >
          @error('photos')
          <div class="invalid-feedback">{{$message}}</div>
          @enderror
          @error('photos.*')
          <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Post Description</label>
        <textarea form="postUpdateForm" type="text" class="form-control @error('description') is-invalid @enderror" rows="10" name="description" id="description">
        {{old('description',$post->description)}}
        </textarea>
        @error('description')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
      <div class="d-flex justify-content-between">
        <div class="d-flex">
          @isset($post->featured_image)
          <img src="{{asset('storage/'.$post->featured_image)}}" height="70" width="70" class="me-3 rounded" alt="">
          @endisset

          <div class="">
            <label for="featured_image" class="form-label">Post Featured Image</label>
            <input
            form="postUpdateForm"
            type="file" 
            class="form-control @error('featured_image') is-invalid @enderror" 
            name="featured_image" id="featured_image" 
            >
            @error('featured_image')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

        </div>
        <button class="btn btn-lg btn-primary" form="postUpdateForm">Edit Post</button>
      </div>

    
  </div>
</div>
@endsection