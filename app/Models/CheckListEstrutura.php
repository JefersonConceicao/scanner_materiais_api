<?php

//OTHER'S NAMESPACES
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

//MODELS
use App\Models\CheckListModelo;

class CheckListEstrutura extends Model
{
    protected $table = 'checklist_estrutura';
    protected $primaryKey = 'Estrutura_id';
    protected $fillable = [
        'modelo_id',
        'itens_id'
    ];

    public $timestamps = false;

    public function modelos(){
        return $this->hasOne(CheckListModelo::class, 'id', 'modelo_id');
    }

    public function getModelos($request = []){
        $conditions = [];

        if(isset($request['modelo']) && !empty($request['modelo'])){
            $conditions[] = ['modelo_id', '=', $request['modelo']];
        }

        return $this
            ->select('modelo_id')
            ->where($conditions)
            ->distinct()
            ->with('modelos')
            ->paginate(7);
    }
}
