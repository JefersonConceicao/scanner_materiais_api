<?php

//OTHER'S NAMESPACES
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function getModelosEstrutura($request = []){
        $conditions = [];

        if(isset($request['modelo']) && !empty($request['modelo'])){
            $conditions[] = ['checklist_estrutura.modelo_id', '=', $request['modelo']];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['checklist_modelo.ativo', '=', $request['ativo']];
        }

        return $this
            ->join('checklist_modelo', 'checklist_modelo.id', 'checklist_estrutura.modelo_id')
            ->select(
                    DB::raw('DISTINCT checklist_estrutura.modelo_id'),
                     'checklist_modelo.*'
                )
            ->where($conditions)
            ->get();
    }

    public function getItensByModelo($id){
        return $this
            ->where('modelo_id', $id);
    }

    public function saveCheckListEstrutura($request = []){
        try{
            DB::beginTransaction();

            if(isset($request['itens_id']) && !empty($request['itens_id'])){
                foreach($request['itens_id'] as $k => $v){
                    $formData = [
                        'modelo_id' => $request['modelo_id'],
                        'itens_id' => $v
                    ];

                    $this->create($formData);
                    unset($formData);
                }
            }

            DB::commit();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];

        }catch(\Exception $error){
            DB::rollback();
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente novamente',
                'msg' => $error->getMessage()
            ];
        }
    }   

    public function updateCheckListEstrutura($id, $request = []){
        try{            
            DB::beginTransaction();

            if(isset($request['itens_id']) && !empty($request['itens_id'])){
                $this->where('modelo_id', $id)->delete();    

                foreach($request['itens_id'] as $k => $v){
                    $formData = [
                        'modelo_id' => $id,
                        'itens_id' => $v
                    ];  

                    $this->create($formData);
                    unset($formData);
                }
            }

            DB::commit();
            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $err){
            DB::rollback();
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro, tente novamente',
                'error_msg' => $err->getMessage()
            ];
        }
    }

    public function deleteCheckListEstrutura($id){

    }
}
