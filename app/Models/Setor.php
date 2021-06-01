<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Setor extends Model
{
    protected $table = 'setor';
    protected $fillable = [
        'sigla',
        'descsetor',
        'diretoria_id',
        'hierarquia',
        'e_mail',
        'ativo',
        'deleted_at',
    ];

    public $timestamps = false;

    public function getSetores(){
        return $this->all();
    }
}
