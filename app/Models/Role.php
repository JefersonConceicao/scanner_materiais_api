<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable =[
        'name',
        'slug',
        'description',
    ];

    public $timestamps = true;

    public function getRoles(){
       return $this->all();
    }

}
