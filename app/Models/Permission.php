<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Permission;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = true;

    public function funcionalidades(){
        return $this->belongsToMany(Funcionalidade::class);
    }

    public function getPermissionsVinculed(){
        return $this
            ->select('name','id')
            ->whereRaw('
                id IN (
                    SELECT permission_id FROM funcionalidade_permission
                );')
            ->pluck('name','id')
            ->toArray();  
    }

    public function getPermissionsOrfas(){
        return $this
            ->select(
                DB::raw('CONCAT(name, "*") as nameOrfa'),
                'id'
                )
            ->whereRaw(
                'id NOT IN (
                    SELECT permission_id FROM funcionalidade_permission
                );'
            )->pluck('nameOrfa','id')->toArray();
    }

    public function permissionsAdded(){
        $routes = \Route::getRoutes();
        $routeNames = $this->prepareNameRoutes($routes);
        $dbPermissions = $this->pluck('name')->toArray();

        return array_diff($routeNames, $dbPermissions);
    }

    public function permissionsRemoved(){
        $routes = \Route::getRoutes();
        $routeNames = $this->prepareNameRoutes($routes);
        $dbPermissions = $this->pluck('name')->toArray();
        
        return array_diff($dbPermissions, $routeNames);
    }
    
    public function permissionsNoRelations(){
        return $this->doesntHave('funcionalidades')->get();
    }

    public function permissionAuthorized($nameRoute){
        if(strpos($nameRoute, "::") !== false){
            $nameRoute = str_replace("::", ".", $nameRoute);
        }

        $sessionPermissions = \Session::get('user_permissions');
        return in_array($nameRoute, $sessionPermissions);
    }

    public function savePermissions(){
        $permissionsAdded = $this->permissionsAdded();
        $permissionsRemoved = $this->permissionsRemoved();

        if(!empty($permissionsAdded)){
            foreach($permissionsAdded as $permission){
                $this->create([
                    'name' => $permission,
                    'description' => 'permission'
                ]);
            }
        }

        if(!empty($permissionsRemoved)){
            $this->whereIn('name', $permissionsRemoved)->delete();
        }

        return [
            'permissionsAdded' => $permissionsAdded,
            'permissionsRemoved' => $permissionsRemoved,
        ];
    }   

    public function prepareNameRoutes($routes){
        $routeNames = [];
        

        foreach($routes as $route){
            if(!empty($route->getName())){
                $routeNames[] = str_replace('::','.', $route->getName());
            }
        }

        return $routeNames;
    }
}
