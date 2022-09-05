@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post</li>
  </ol>
</nav>
<div class="card">
  <div class="card-body">
    @if(session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
    @endif
    
    <div class="d-flex justify-content-between align-items-center">
      <h2>Post List</h2>
      <a href="{{route('post.create')}}" class="text-primary pr-2"><i class="fa fa-2x fa-plus-circle"></i></a>
    </div>
    <div class="d-flex justify-content-between">
      <div class="">
        @if(request('keyword'))
        Search by <span>{{request('keyword')}}</span>
        <a href="{{route('post.index')}}" class="text-danger"><i class="bi bi-trash3"></i></a>
        @endif
      </div>
      <form action="{{route('post.index')}}" method="get" class="">
        @csrf
        <div class="input-group">
        <input type="text" name="keyword" class="form-control">
        <button class="btn btn-primary">
          <i class="bi bi-search"></i>Search
        </button>
        </div>
      </form>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Category</th>
          @if(!Auth::user()->isAuthor())
          <th>Owner</th>
          @endif
          <th>Control</th>
          <th>Created AT</th>
        </tr>
      </thead>
      
      <tbody>
        @foreach($posts as $post)
        <tr class="text-middle">
          <td>{{$post->id}}</td>
          <td class="w-25">
            {{$post->title}}           
          </td>
          <td>
            {{$post->category->title}}
          </td>
          @if(!Auth::user()->isAuthor())
          <td>
            {{$post->user->name}}
          </td>
          @endif
          <td class="">
          <a href="{{route('post.show',$post->id)}}" class="btn btn-outline-info btn-sm">
              <i class="bi bi-info-circle"></i>
            </a>
            @can('delete',$post)
              @if(request()->trash)
              <form action="{{route('post.destroy',[$post->id,'delete'=>'force'])}}" method="post" class="d-inline-block">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger btn-sm">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
              <form action="{{route('post.destroy',[$post->id,'delete'=>'restore'])}}" method="post" class="d-inline-block">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger btn-sm">
                  <i class="bi bi-recycle"></i>
                </button>
              </form>
              @else
              <form action="{{route('post.destroy',[$post->id,'delete'=>'soft'])}}" method="post" class="d-inline-block">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger btn-sm">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
              @endif
            @endcan
            @can('update',$post)
            <a href="{{route('post.edit',$post->id)}}" class="btn btn-outline-warning btn-sm">
              <i class="bi bi-pencil"></i>
            </a>
            @endcan
          </td>
          <td>
            <p><i class="bi bi-calendar"></i>{{$post->created_at->format('d m Y')}}</p>
            <p><i class="bi bi-alarm"></i>{{$post->created_at->format('g:m A')}}</p>
          </td>
        </tr>
        @endforeach
        @if(empty($post))
        <tr>
          <td colspan="6">There is no post</td>
        </tr>
        @endif
      </tbody>
    </table>
    <div class="">
      {{$posts->onEachSide(1)->links()}}
    </div>
  </div>
</div>
@endsection