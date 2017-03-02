<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        
        return view('categories.index', compact('categories'));
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = $category->posts()
            ->published()
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);;
        
        return view('categories.show', compact('category', 'posts'));
    }
}
