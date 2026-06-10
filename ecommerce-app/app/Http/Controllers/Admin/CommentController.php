<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        return view('admin.comments.index', [
            'comments' => Comment::with(['product', 'user'])->latest()->paginate(15),
        ]);
    }
}
