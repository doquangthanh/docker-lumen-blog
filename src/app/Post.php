<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   public function user()
   {
   		return $this->belongsTo(User::class);
   }

   public function tags()
   {
   		return $this->belongsToMany(Tag::class);
   }

      public function category()
   {
   		return $this->belongsTo(Category::class);
   }
}
