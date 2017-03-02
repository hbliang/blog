<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Services\FileManager\ImageHandler;
use App\Services\Markdown\Markdown;
use App\Tag;
use Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $inputs = $request->all();
        $inputs['content'] = Markdown::instance()->convertMarkdownToHtml($request->input('content_original', ''));
        $inputs['excerpt'] = Post::makeExcerpt($inputs['content']);
        if ($request->hasFile('cover')) {
            $inputs['cover'] = ImageHandler::instance()->store($request->file('image'));
        }

        $post = new Post($inputs);

        Auth::user()->posts()->save($post);

        $post->attachTagsByTagNames($request->input('tags'));


        return redirect()->route('admin.posts.index')->with('success', 'Post Create Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        $tags = Tag::all();

        // array of the tags' name of current post
        $postTagNameArray = $post->tags()->get()->pluck('name')->all();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'postTagNameArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $inputs = $request->all();
        $inputs['content'] = Markdown::instance()->convertMarkdownToHtml($request->input('content_original', ''));
        $inputs['excerpt'] = Post::makeExcerpt($inputs['content']);
        if ($request->hasFile('cover')) {
            $inputs['cover'] = ImageHandler::instance()->store($request->file('cover'));
        }
        
        $post->fill($inputs)->save();

        $post->attachTagsByTagNames($request->input('tags'));

        return redirect()->route('admin.posts.index')->with('success', 'Update Post Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route()->with('success', 'Delete Post Successfully');
    }
}
