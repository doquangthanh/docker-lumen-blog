<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   public function users()
   {
   		return $this->hasMany(Post::class);
   }

      public function role()
   {
   		return $this->belongsTo(Role::class);
   }
}
