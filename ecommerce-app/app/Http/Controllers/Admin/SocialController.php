<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\View\View;

class SocialController extends Controller
{
    public function index(): View
    {
        return view('admin.socials.index', [
            'socials' => Social::latest()->paginate(15),
        ]);
    }
}
