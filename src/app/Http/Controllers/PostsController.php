<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Services\PostSlugBuilder;


class PostsController extends Controller
{
    /* Display all posts */
    public function posts()
    {

        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Get the specified Post from DB.
     * @param  int  $id
     */
    public function postById($id)
    {
        $post = Post::where('id', $id)->first();
        if(count($post)){
            return response()->json($post);
        }
        else{
            return response()->json(['status' => 'Post is not available or deleted!']);
        }
    }

     /**
    * Create new Post
     */
    //  public function createPost(Request $request)
    //  {

    //     $this->validate($request, [
    //         'title' => 'required',
    //         'content' => 'required',
    //         'status' => 'required',
    //         'slug' => 'required'
    //         'category_id' => 'required'
    //         'author_id' => 'required'
    //         ]);

    //     $defaultStatus = 2; /*2 = pending for Admin approval*/

    //     $post = new Post();
    //     $post->title = $request->title;
    //     $post->content = $request->content;
    //     $post->status = $request->$defaultStatus;
    //     $post->slug = $required->PostSlugBuilder::createSlug($request->$title)
    //     $post->recommends = $request->$recommends
    //     $post->rating = $request->$rating
    //     $post->category_id = $request->$category_id
    //     $post->author_id = $request->$author_id
    //     'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

    //     $post->save();

    //     return response()->json(['status' => 'success']);
    // }
}
