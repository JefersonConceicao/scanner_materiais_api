<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Setor extends Model
{
    protected $table = 'setores';
    protected $fillable = [
        'nome_setor',
        'ativo'
    ];

    public $timestamps = false;

    public function getSetores(){
        return $this->all();
    }
}
