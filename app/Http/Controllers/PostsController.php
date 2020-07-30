<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Post;
use App\Tag;

class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('category',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {   
        $image=$request->image->store('posts');
        $posts=Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$image,
            'published_at'=>$request->published_at,
            'category_id'=>$request->category
        ]);

        if($request->tag){
            $posts->tags()->attach($request->tag);
        }
        session()->flash('success','Posts Create Successfully');
            return redirect(route('posts.index'));
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('category',Category::all())->with('tag',Tag::all());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request,Post $post)
    {
        $data=$request->only(['title','description','content','published_at']);

        if($request->hasFile('image')){
            $image=$request->image->store('posts');

            $post->deleteimage();
            $data['image']=$image;
        }
        $post->update($data);

        session()->flash('edit','Posts Update Successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();

        if($post->trashed()){
            $post->deleteimage();
            $post->forceDelete();
        }
        else{
            $post->delete();
        }

        session()->flash('delete','Posts Deleted Successfully');

        return redirect(route('posts.index'));
    }



    public function trashed(){
        $trashed=Post::onlyTrashed()->get();

        return view('posts.index')->with('posts',$trashed);
    }


    public function restore($id){
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();

        $post->restore();
        session()->flash('success','Posts Restore Successfully');

        return redirect()->back();
    }
}
 