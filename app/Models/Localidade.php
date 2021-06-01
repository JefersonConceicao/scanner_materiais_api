<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Localidade extends Model
{
    protected $table = 'localidade';
    protected $fillable = [
        'localidade',
        'localidade_pai_id',
        'territorio_turistico_id',
        'zona_turistica_id',
        'uf_id',
        'pais_id',
        'ativo',
        'codimp',
        'populacao',
        'area',
        'altitude',
        'principais_estradas',
        'coelba',
        'embasa',
        'Aniversario',
        'fundacao',
        'nome_padroeiro',
        'dia_padroeiro',
        'dt_turistica_ini',
        'dt_turistica_fim',
        'historico',
        'mp_2009',
        'mp_2013',
        'mp_2016',
        'mp_2017',
        'mp_2019',
        'mp_2021',
        'mp_2023',
        'sj_2007',
        'sj_2008',
        'sj_2009',
        'sj_2010',
        'sj_2011',
        'sj_2012',
        'sj_2013',
        'sj_2014',
        'sj_2015',
        'sj_2016',
        'sj_2017',
        'sj_2018',
        'sj_2019',
        'sj_2020',
        'sj_2021',
        'sj_2022'
    ];

    public $timestamps = false;

    protected $nullables = [
        'mp_2009',
        'mp_2013',
        'mp_2016',
        'mp_2017',
        'mp_2019',
        'mp_2021',
        'mp_2023',
        'sj_2007',
        'sj_2008',
        'sj_2009',
        'sj_2010',
        'sj_2011',
        'sj_2012',
        'sj_2013',
        'sj_2014',
        'sj_2015',
        'sj_2016',
        'sj_2017',
        'sj_2018',
        'sj_2019',
        'sj_2020',
        'sj_2021',
        'sj_2022'
    ];

    public function territorioTuristico(){
        return $this->belongsTo(TerritorioTuristico::class);
    }

    public function zonaTuristica(){
        return $this->belongsTo(ZonaTuristica::class);
    }
    
    public function pais(){
        return $this->belongsTo(Pais::class);
    }

    public function uf(){
        return $this->belongsTo(UF::class);
    }

    public function localidadeDistancia(){
        return $this->hasMany(LocalidadeDistancia::class);
    }

    public function localidadeInfraEstrutura(){
        return $this->hasMany(LocalidadeInfraestrutura::class);
    }

    public function localidadeEventoFesta(){
        return $this->hasMany(LocalidadeEventoFesta::class);
    }

    public function getLocalidades($searchParams = []){
        $conditions = [];

        if(isset($searchParams['codigo']) && !empty($searchParams['codigo'])){
            $conditions[] = ['localidade.id', '=', $searchParams['codigo']];
        }

        if(isset($searchParams['localidade']) && !empty($searchParams['localidade'])){
            $conditions[] = ['localidade.localidade', 'LIKE', "%".$searchParams['localidade']."%"];
        }

        if(isset($searchParams['uf']) && !empty($searchParams['uf'])){
            $conditions[] = ['localidade.uf_id', '=', $searchParams['uf']];
        }   

        if(isset($searchParams['pais']) && !empty($searchParams['pais'])){
            $conditions[] = ['localidade.pais_id', '=', $searchParams['pais']];
        }

        if(isset($searchParams['territorio_turistico_id']) && !empty($searchParams['territorio_turistico_id'])){
            $conditions[] = ['localidade.territorio_turistico_id', '=', $searchParams['territorio_turistico_id']];   
        }

        if(isset($searchParams['zona_turistica_id']) && !empty($searchParams['zona_turistica_id'])){
            $conditions[] = ['localidade.zona_turistica_id', '=', $searchParams['zona_turistica_id']];
        }

        if(isset($searchParams['populacao']) && !empty($searchParams['populacao'])){
            $conditions[] = ['localidade.populacao', 'LIKE', "%".$searchParams['populacao']."%"];
        }

        if(isset($searchParams['area']) && !empty($searchParams['area'])){
            $conditions[] = ['localidade.area', 'LIKE', "%".$searchParams['area']."%"];
        }

        if(isset($searchParams['altitude']) && !empty($searchParams['altitude'])){
            $conditions[] = ['localidade.altitude', 'LIKE', "%".$searchParams['altitude']."%"];
        }    

        if(isset($searchParams['coelba']) && !empty($searchParams['coelba'])){
            $conditions[] = ['localidade.coelba', '=', $searchParams['coelba']];
        }   

        if(isset($searchParams['embasa']) && !empty($searchParams['embasa'])){
            $conditions[] = ['localidade.embasa', '=', $searchParams['embasa']];
        }

        if(isset($searchParams['principais_estradas']) && !empty($searchParams['principais_estradas'])){
            $conditions[] = ['localidade.principais_estradas', 'LIKE', "%".$searchParams['principais_estradas']."%"];
        }    

        if(isset($searchParams['nome_padroeiro']) && !empty($searchParams['nome_padroeiro'])){
            $conditions[] = ['localidade.nome_padroeiro', 'LIKE' , "%".$searchParams['nome_padroeiro']."%"];
        }

        if(isset($searchParams['aniversario']) && !empty($searchParams['aniversario'])){
            $dateParam = str_replace("/", "-", $searchParams['aniversario'])."-0001";
            $conditions[] = ['localidade.aniversario', '=', converteData($dateParam, "Y-m-d")];
        }

        if(isset($searchParams['fundacao']) && !empty($searchParams['fundacao'])){
            $conditions[] = [
                'localidade.fundacao', 
                '=', 
                converteData(str_replace("/", "-", $searchParams['fundacao']), 'Y-m-d')
            ];
        }

        if(isset($searchParams['historico']) && !empty($searchParams['historico'])){
            $conditions[] = ['localidade.historico', 'LIKE', "%".$searchParams['historico']."%"];
        }

        return $this
            ->select(
                'tt.territorio_turistico as territorio_turistico', 
                'pais.pais as pais',
                \DB::raw("(SELECT localidade FROM localidade WHERE localidade.localidade_pai_id = localidade.id) as nome_localidade_pai"),
                'uf.uf_sigla as uf',
                'zt.zona_turistica as zona_turistica',
                'localidade.*'
            )
            ->leftJoin('territorio_turistico as tt', 'localidade.territorio_turistico_id', 'tt.id')
            ->join('pais','localidade.pais_id', 'pais.id')
            ->join('uf', 'localidade.uf_id', 'uf.id')
            ->leftJoin('zona_turistica as zt', 'localidade.zona_turistica_id', 'zt.id')
            ->where($conditions)
            ->orderBy('localidade.id', 'DESC');
    }

    public function saveLocalidade($request = []){
        try{
            if(isset($request['Aniversario']) && !empty($request['Aniversario'])){
                $splitDate = explode('-', str_replace("/","-", $request['Aniversario']));
                $request['Aniversario'] = "0001-".$splitDate[1]."-".$splitDate[0];
            }     

            if(isset($request['dia_padroeiro']) && !empty($request['dia_padroeiro'])){
                $splitDate = explode('-', str_replace("/","-", $request['dia_padroeiro']));
                $request['dia_padroeiro'] = "0001-".$splitDate[1]."-".$splitDate[0];
            }

            if(isset($request['fundacao']) && !empty($request['fundacao'])){
                $request['fundacao'] = converteData(str_replace('/','-',$request['fundacao']), 'Y-m-d');
            }

            $this->fill($request)->save();
            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!',
                'register' => $this->id
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro',
                'error_msg' => $err->getMessage()
            ];
        }   
    }

    public function updateLocalidade($id, $request = []){
        try{
            if(isset($request['Aniversario']) && !empty($request['Aniversario'])){
                $splitDate = explode('-', str_replace("/","-", $request['Aniversario']));
                $request['Aniversario'] = "0001-".$splitDate[1]."-".$splitDate[0];
            }     

            if(isset($request['dia_padroeiro']) && !empty($request['dia_padroeiro'])){
                $splitDate = explode('-', str_replace("/","-", $request['dia_padroeiro']));
                $request['dia_padroeiro'] = "0001-".$splitDate[1]."-".$splitDate[0];
            }

            if(isset($request['fundacao']) && !empty($request['fundacao'])){
                $request['fundacao'] = converteData(str_replace('/','-',$request['fundacao']), 'Y-m-d');
            }
            
            //SUBSTITUI CAMPOS NULOS POR VALOR PADRÃO N (NÃO/NEGATIVO)
            foreach($this->nullables as $k => $v){
                if(!isset($request[$v])){
                    $request[$v] = "N";
                }
            }

            $localidade = $this->find($id);
            $localidade->fill($request)->save();
            
            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o regsitro'
            ];
        }
    }

    public function deleteLocalidade($id){
        try{
            DB::beginTransaction();
            $this->find($id)->localidadeDistancia()->delete();
            $this->find($id)->localidadeInfraEstrutura()->delete();
            $this->find($id)->localidadeEventoFesta()->delete();
            $this->find($id)->delete();

            DB::commit();
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }catch(\Exception $err){
            DB::rollback();
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, pois o mesmo ainda está sendo utilizado',
            ];
        }
    }

    public function getLocalidadeById($id){
        return $this
            ->find($id);
    }

    public function getLocalidadeDistancia($id){
        return $this
            ->find($id)
            ->localidadeDistancia()
            ->select(
                'localidade_distancias.*', 
                \DB::raw(
                        '(select localidade from localidade where id = localidade_distancias.localidade_distancia_id)
                         as loc_distancia'
                        )
            )
            ->paginate(5);
    }   

    public function getLocalidadeInfraestrutura($id){
        return $this
            ->find($id)
            ->localidadeInfraEstrutura()
            ->select(
                    'localidade_infraestrutura.*',
                    \DB::raw('(select nome_tipo from tipo_infraestrutura where id = localidade_infraestrutura.tipo_id) as nome_tipo_projeto') 
                )
            ->paginate(5);
    }

    public function getLocalidadeEventoFesta($id){
        return $this
            ->find($id)
            ->localidadeEventoFesta()
            ->select(
                'localidade_evento_festa.*',
                \DB::raw('(select nome_tipo from tipo_evento_festa where id = localidade_evento_festa.tipo_evento_festa_id) as nome_tp_festa')
            )
            ->paginate(5);
    }
}
