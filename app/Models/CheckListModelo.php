<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckListModelo extends Model
{
    protected $table = 'checklist_modelo';
    protected $fillable = [
        'modelo',
        'ativo',
    ];

    public $timestamps = false;
}
