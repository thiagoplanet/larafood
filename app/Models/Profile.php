<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name','description'];

    /**
     * get Permissions
     */

     public function permissions()
     {
         //segundo parametro passamos o nome da table pivo, já está certo porem coloquei para conhecimento
         return $this->belongsToMany(Permission::class,'permission_profile');
     }


     public function plans(){
         return $this->belongsToMany(Plan::class);
     }

     public function permissionsAvailable($filter = null)
     {
        //pegando as permissoes que não estão ainda vinculadas
        $permissions = Permission::whereNotIn('permissions.id', function($query){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");//da subselect
        })
        ->where(function($queryFilter) use ($filter){ //usando o filtro enviado pela request, só vai usar se existir dados
            if($filter){
                $queryFilter->where('permissions.name','LIKE',"%$filter%");
            }
        })
        ->paginate();
        //podemos trocar por toSql() o paginate para debugar com dd($permissions) ver o resultado do SQL

        return $permissions;
     }
}
