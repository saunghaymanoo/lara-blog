@extends('layouts.app1')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">User</li>
  </ol>
</nav>
<div class="card">
  <div class="card-body">
    @if(session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
    @endif
    
    <div class="d-flex justify-content-between align-items-center">
      <h2>User List</h2>
      <!-- <a href="{{route('post.create')}}" class="text-primary pr-2"><i class="fa fa-2x fa-plus-circle"></i></a> -->
    </div>
    <div class="d-flex justify-content-between">
      <div class="">
        @if(request('keyword'))
        Search by <span>{{request('keyword')}}</span>
        <a href="{{route('user.index')}}" class="text-danger"><i class="bi bi-trash3"></i></a>
        @endif
      </div>
      <form action="{{route('user.index')}}" method="get" class="">
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
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Control</th>
          <th>Created AT</th>
        </tr>
      </thead>
      
      <tbody>
        @foreach($users as $user)
        <tr class="text-middle">
          <td>{{$user->id}}</td>
          <td class="w-25">
            {{$user->name}}           
          </td>
          <td>
            {{$user->email}}
          </td>
          <td>
           
          </td>
          <td class="">
          <a href="{{route('user.show',$user->id)}}" class="btn btn-outline-info btn-sm">
              <i class="bi bi-info-circle"></i>
            </a>
            <form action="{{route('user.destroy',$user->id)}}" method="post" class="d-inline-block">
              @csrf
              @method('delete')
              <button class="btn btn-outline-danger btn-sm">
                <i class="bi bi-trash"></i>
              </button>
            </form>
            @can('update',$user)
            <a href="{{route('user.edit',$user->id)}}" class="btn btn-outline-warning btn-sm">
              <i class="bi bi-pencil"></i>
            </a>
            @endcan
          </td>
          <td>
            <p><i class="bi bi-calendar"></i>{{$user->created_at->format('d m Y')}}</p>
            <p><i class="bi bi-alarm"></i>{{$user->created_at->format('g:m A')}}</p>
          </td>
        </tr>
        @endforeach
        @if(empty($user))
        <tr>
          <td colspan="6">There is no user</td>
        </tr>
        @endif
      </tbody>
    </table>
    <div class="">
      {{$users->onEachSide(1)->links()}}
    </div>
  </div>
</div>
@endsection