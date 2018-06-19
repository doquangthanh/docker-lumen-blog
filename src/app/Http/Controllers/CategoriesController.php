<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    /* Display all categories */
    public function categories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Get the specified Category from DB.
     * @param  int  $id
     */
    public function categoryById($id)
    {
        $category = Category::where('id', $id)->first();
        if(count($category)){
            return response()->json($category);
        }
        else{
            return response()->json(['status' => 'Category is not available or deleted!']);
        }
    }
}
