<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all posts information

        $posts = Post::orderBy('id' , 'desc')->paginate(5);

        //return the view 

        return view('posts.index')->withPosts($posts) ;
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // You Can Create Post From Here Go to --> STORE
        return view('posts.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Validate The Data
        $this->validate($request , array(
                'title' =>'required|max:255',
                'body' => 'required',
                'slug' => 'required|alphadash|unique:posts,slug'
            ));

        // Store In Database
        $post = new Post ;

        $post->title = $request->title ;
        $post->body = $request->body;
        $post->slug = $request->slug;
        $post->created_at = now();
        
        $post->save();

        //pass a success massage
        Session::flash('success','The Blog Post Have Succefuly Saved !!');
        // Redirect To Show Page 
        return redirect()->route('posts.show' , $post->id);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Get All Data About The Post
        $post = Post::find($id);
        //return view to edite.blade.php
        return view ('posts.edit')->withPost($post);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request , array(
                'title' =>'required|max:255',
                'body' => 'required',
                'slug' => 'required|unique:posts,slug'
            ));

        // Store In Database
        $post = Post::find($id) ;

        $post->title = $request->input('title') ;
        $post->body = $request->input('body');
        $post->slug = $request->input('slug');
        $post->updated_at = now();
        
        $post->save();

        //pass a success massage
        Session::flash('success','This Post Have Succefuly Updated !!');
        // Redirect To Show Page 
        return redirect()->route('posts.show' , $post->id);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id) ;
        $post->delete();
        Session::flash('success','This Post Have Succefuly Deleted !!');
        return redirect()->route('posts.index') ;
    }
}
