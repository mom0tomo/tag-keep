<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function index()
    {
        return Tag::take(500)->orderBy('id', 'desc')->get();
    }
    public function store(Request $request)
    {
        return Tag::create([
            'title' => request('title'),
            'content' => request('content'),
        ]);
    }

    public function destroy($id)
    {
        return Tag::destroy($id);
    }
}
