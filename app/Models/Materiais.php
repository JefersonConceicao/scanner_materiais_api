<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiais extends Model
{
    protected $table = 'materiais';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo_barra_material',
        'nome_material',
        'verificado'
    ];  
    public $timestamps = false;

    public function verificaMaterialPorCódigo($request = []){
        try{
            $materialByScan = $this->where('codigo_barra_material', $request['codigo_barra']);

            if($materialByScan->exists()){
                $materialByScan->update(['verificado' => 1]);

                return [
                    'error' => false,
                    'checked' => true,
                    'msg' => 'Material encontrado',
                    'material' => $materialByScan->first()
                ];
            }else{
                return [
                    'error' => false,
                    'checked' => false,
                    'msg' => 'Nenhum material encontrado',
                    'material' => null  
                ];
            }

        }catch(\Exception $error){
            return [
                'error' => true,
                'checked' => false,
                'error_message' => $error->getMessage()
            ];
        }
    }
}