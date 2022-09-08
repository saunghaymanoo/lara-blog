@extends('layouts.app1')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
  </ol>
</nav>
<div class="card">
  <div class="card-body">
    <div class="gallery">
        @forelse(Auth::user()->photos as $photo)
        <img src="{{ asset('storage/'.$photo->name) }}" alt="" />
        @empty
        <p>There is no photos...</p>
        @endforelse
    </div>
  </div>
</div>
@endsection