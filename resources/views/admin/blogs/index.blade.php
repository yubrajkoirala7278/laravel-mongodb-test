@extends('admin.layouts.app')
@section('content')
<div class="container">
   <a href="{{route('blogs.create')}}" class="btn btn-success">Create Blog</a>
    <table class="table mt-4">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $key=>$blog)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->slug}}</td>
                <td>
                    <img src="{{asset('storage/images/blogs/'.$blog->image->image)}}" alt="" style="height: 20px">
                </td>
                <td>{{$blog->description}}</td>
                <td>
                    <form action="{{route('blogs.destroy',$blog->slug)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{route('blogs.edit',$blog->slug)}}" class="btn btn-warning">Edit</a>
                </td>
              </tr>
            @endforeach
          
        </tbody>
      </table>
</div>
@endsection