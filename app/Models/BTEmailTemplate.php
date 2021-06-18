<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BTEmailTemplate extends Model
{
    protected $table = 'email_templates';
    protected $fillable = [
        'titulo',
        'conteudo_html',
        'ativo'
    ];
    
    public $timestamps = false;

    public function getBTEmailTemplate($request = []){
        return $this
                ->paginate(7);
    }   

    public function saveBTEmailTemplate($request = []){

    }

    public function updateBTEmailTemplate($id, $request = []){

    }

    public function deleteBTEmailTemplate($id){

    }
}
