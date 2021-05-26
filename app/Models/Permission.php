<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','description'];


    /**
     * get Permissions
     */

     public function profile()
     {
         //segundo parametro passamos o nome da table pivo, já está certo porem coloquei para conhecimento
         return $this->belongsToMany(Profile::class,'permission_profile');
     }

}
