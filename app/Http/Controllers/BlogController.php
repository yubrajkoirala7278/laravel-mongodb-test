<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('image')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (isset($request['image'])) {
                $timestamp = now()->timestamp;
                $originalName = $request['image']->getClientOriginalName();
                $imageName = $timestamp . '-' . $originalName;
                $request['image']->storeAs('public/images/blogs', $imageName);

                // update the image name in $request array
                $request['image'] = $imageName;
            }
           $blog=Blog::create([
                'title' => $request['title'],
                'slug' => $request['slug'],
                'description' => $request['description']
            ]);
            Image::create([
                'image'=>$imageName,
                'blog_id'=>$blog->id,
            ]);
            return redirect()->route('blogs.index')->with('success', 'Blog added successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
       try{
        return view('admin.blogs.edit',compact('blog'));
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        try{
            if(isset($request['image'])){
                // Delete the old image from storage folder
                Storage::delete('public/images/blogs/'.$blog->image->image);
                // Store the new image
                $timestamp = now()->timestamp;
                $originalName = $request['image']->getClientOriginalName();
                $imageName = $timestamp . '-' . $originalName;
                $request['image']->storeAs('public/images/blogs', $imageName);
                // Update the image name in the $request array
                $blog->update([
                    'title' => $request['title'],
                    'slug' => $request['slug'],
                    'description' => $request['description']
                ]);
                $blog->image->update([
                    'image' => $imageName,
                ]);
            }else{
                $blog->update([
                    'title' => $request['title'],
                    'slug' => $request['slug'],
                    'description' => $request['description']
                ]);
            }
           
            return redirect()->route('blogs.index')->with('success','Blog updated successfully!');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        try {
            Storage::delete('public/images/blogs/' . $blog->image->image);
            $blog->image->delete();
            $blog->delete();
            return back()->with('success', 'Blog deleted successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
