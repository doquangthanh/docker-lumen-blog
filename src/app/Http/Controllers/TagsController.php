<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    /* Display all posts */
    public function tags()
    {

        $tags = Tag::all();
        return response()->json($tags);
    }

    /**
     * Get the specified Post from DB.
     * @param  int  $id
     */
    public function tagById($id)
    {
        $tag = Tag::where('id', $id)->first();
        if(count($tag)){
            return response()->json($tag);
        }
        else{
            return response()->json(['status' => 'Tag is not available or deleted!']);
        }
    }
}
