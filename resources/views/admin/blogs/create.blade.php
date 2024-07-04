@extends('admin.layouts.app')
@section('content')
<div class="container">

    <form method="POST" action="{{route('blogs.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="title" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">slug</label>
            <input type="slug" class="form-control" id="slug" name="slug">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <button class="btn btn-success" type="submit">Submit</button>
    </form>
</div>
@endsection