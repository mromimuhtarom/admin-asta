<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'adm_role';
    protected $fillable = ['name'];
    protected $primaryKey = 'role_id';
  
    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;
  
    public function getRouteKeyName()
    {
        return 'role_id';
    }
}
