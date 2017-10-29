<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function index()
    {
        return Tag::take(5)->get()->keyBy('id');
    }
    public function store(Request $request)
    {
        return Tag::create($request->only('content'))->save()->fresh();
    }

    public function destroy($id)
    {
        return Tag::destroy($id);
    }

    public function update($id, Request $request)
    {
        return Tag::find($id)->fill($request->only('is_done'))
               ->save()->fresh();
    }
}
