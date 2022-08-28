<div class="list-group mb-3">
    <a href="{{route('home')}}" class="list-group-item">Home</a>
</div>
<div class="list-group">
    <a href="{{route('photo.index')}}" class="list-group-item">Gallery</a>
</div>

<p class="text-black-50 mb-1">Post Manage</p>
<div class="mb-3">
<div class="list-group">
    <a href="{{route('post.index')}}" class="list-group-item">Post List</a>
</div>
<div class="list-group">
    <a href="{{route('post.create')}}" class="list-group-item">Create Post</a>
</div>
</div>

<p class="text-black-50 mb-1">Category Manage</p>
<div class="mb-3">
<div class="list-group">
    <a href="{{route('category.index')}}" class="list-group-item">Category List</a>
</div>
<div class="list-group">
    <a href="{{route('category.create')}}" class="list-group-item">Create Category</a>
</div>
</div>

@isAdmin
<p class="text-black-50 mb-1">User Manage</p>
<div class="mb-3">
<div class="list-group">
    <a href="{{route('user.index')}}" class="list-group-item">User List</a>
</div>
<!-- <div class="list-group">
    <a href="{{route('user.create')}}" class="list-group-item">Create User</a>
</div> -->
</div>
@endisAdmin

