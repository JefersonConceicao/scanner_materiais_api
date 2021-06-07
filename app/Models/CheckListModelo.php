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

    public function checklistEstrutura(){
        return $this->hasMany(CheckListEstrutura::class, 'modelo_id', 'id');
    } 

    public function getModelosWithoutRelations(){
        return $this->whereDoesntHave('checkListEstrutura');
    }   
}
