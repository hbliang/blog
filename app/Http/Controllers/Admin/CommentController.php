<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('post', 'user')->paginate(5);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        return redirect()->back()->with('success', 'Delete Comment Successfully');

    }

    public function toggleStatus($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->toggleStatus()->save();

        return [
            'message' => 'success',
        ];
    }
}
