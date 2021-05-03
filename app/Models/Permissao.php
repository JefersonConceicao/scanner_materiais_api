<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = "permissions";
    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = true;

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
