<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use App\Post;
use Auth;

class PostsController extends Controller
{
    //place auth here
    public function __construct()
    {
        //'except' allows an array of index and show views to be accessed
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        // $posts = Post::orderBy('created_at', 'desc')->get();
        // $posts = Post::orderBy('title', 'desc')->take(1)->get();
        // $post =  Post::where('title', 'Post Three')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image_cover' => 'image|nullable|max:1999'
        ]);

        //File upload here...
        if($request->hasFile('image_cover')) {
            //File name extension
            $fileNameExt = $request->file('image_cover')->getClientOriginalName();
            //Get filename
            $filename = pathinfo($fileNameExt, PATHINFO_FILENAME);
            //Get Extension
            $ext = $request->file('image_cover')->getClientOriginalExtension();
            //filename to store
            $fileNameStoredAs = $filename.'_'.time().'.'.$ext;
            //upload image
            $path = $request->file('image_cover')->storeAs('public/images_cover', $fileNameStoredAs);
        }else {
            $fileNameStoredAs = 'noimage.jpg';
        }

        //create post here
        $post = new Post;
        $post->title = $request->title;
        $post->user_id = auth()->user()->id;
        $post->description = $request->description;
        $post->image_cover = $fileNameStoredAs;
        $post->save();

        return redirect('/posts')->with('success', 'Post has been created successfully!');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //Prevent unauthorized user to edit post
        if(Auth::user()->id !== $post->user_id) {
            //return redirect('/posts');
            return redirect('/posts')->with('error', 'Not Allowed!');
            
        }
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        //File upload here...
        if($request->hasFile('image_cover')) {
            //File name extension
            $fileNameExt = $request->file('image_cover')->getClientOriginalName();
            //Get filename
            $filename = pathinfo($fileNameExt, PATHINFO_FILENAME);
            //Get Extension
            $ext = $request->file('image_cover')->getClientOriginalExtension();
            //filename to store
            $fileNameStoredAs = $filename.'_'.time().'.'.$ext;
            //upload image
            $path = $request->file('image_cover')->storeAs('public/images_cover', $fileNameStoredAs);
        }

        //update post here
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        if($request->hasFile('image_cover')){
            $post->image_cover = $fileNameStoredAs;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post has been updated successfully!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if($post->cover_image != 'noimage.jpg') {
            //Delete the image from storage
            
            Storage::delete('public/images_cover/'.$post->image_cover);
            
        }
        $post->delete();
         
        return redirect('/posts')->with('success', 'Post deleted successfully!');
        
    }
}
