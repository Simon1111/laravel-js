<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Http\Resources\Comments as CommentsResource;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {    
        return view('pages/admin/comments');
    }

    public function api()
    {
        return CommentsResource::collection(Comments::selectRaw('url, count(url) as `count`')->orderByDesc('count')->groupBy('url')->paginate(30));
    }
}