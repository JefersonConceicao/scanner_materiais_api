<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patrimonio extends Model
{
    protected $table = 'patrimonios';
    protected $fillable = [
        'patrimonio',
        'patrimonio_antigo',
        'descricao',
        'situacao_fisica',
        'conta',
        'data_aquisicao',
        'localizacao',
        'observacao',
        'valor_aquisicao'
    ];

    public function getPatrimonioByCodigo($codigo){
        return $this
            ->where('patrimonio', $codigo)
            ->get();
    }
}
