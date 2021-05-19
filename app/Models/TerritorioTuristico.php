<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerritorioTuristico extends Model
{
    protected $table = 'territorio_turistico';
    protected $fillable = [
        'territorio_turistico',
        'ativo',
        'codimp',
    ];

    public $timestamps = false;

    public function getTT($request = []){
        $conditions = [];

        if(isset($request['territorio_turistico']) && !empty($request['territorio_turistico'])){
            $conditions[] = ['territorio_turistico', 'LIKE', "%".$request['territorio_turistico']."%" ];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this    
            ->where($conditions)
            ->paginate(15);
    }

    public function saveTT($request = []){
        try{
            $ttSave = $this->create([
                'territorio_turistico' => $request['territorio_turistico'],
                'ativo' => $request['ativo']
            ]);
    
            $this->find($ttSave->id)->update(['codimp' => $ttSave->id]);

            return [
                'error' => false,
                'msg' => 'Registro incluído com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível incluir o registro',
                'code' => $err->getCode()
            ];
        }
    }

    public function updateTT($id, $request = []){
        try{
            $tt = $this->find($id);
            $tt->fill([
                'territorio_turistico' => $request['territorio_turistico'],
                'ativo' => $request['ativo']
            ])->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Execption $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro'
            ];
        }
    }
    
    public function deleteTT($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Ocorreu um erro ao excluir o registro, tente novamente'
            ];
        }
    }

    public function getTTById($id){
        return $this->find($id);
    }

    public function deleteAllRowsTT($request = []){
        if($this->whereIn('id', $request['ids'])->delete()){
            return [
                'error' => false,
                'msg' => count($request['ids']). " registros excluido(s)"
            ];
        }else{
            return [
                'error' => true,
                'msg' => "Não foi possível excluir o(s) registro(s), o mesmo pode está sendo utilizado em outro lugar"
            ];
        }
    }
}
