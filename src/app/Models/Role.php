<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Role extends Model
{
    protected $table = 'roles';
    
    protected $fillable = [
        'name',
        'updated_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'role_id');
    }
    
    public function getRoles()
    {
        $query = $this;
        return $query->paginate(20);
    }
    
    public function getRole($id)
    {
        return $this->find($id);
    }
    
    public function createRole($input)
    {
        return $this->create($input->all());
    }
    
    public function updateRole($id, $input)
    {
        $updated = $this->find($id)->update($input);
        $role = $this->find($id);
        
        if($updated) {
            return $role;
        }
        
        return false;
    }
}