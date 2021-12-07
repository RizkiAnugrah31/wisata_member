<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPrivilegesModel extends Model {
    //    Soft Delete
    use softDeletes;
   

//    Nama Table
    protected $table = "user_privileges";

//    Nama Primary Key
    protected $primaryKey = "user_privileges_id";

//    Field yang bisa di isi
    protected $fillable = [
        "user_role_id",
        "menu_id",
        "view",
        "add",
        "edit",
        "delete",
        "other"

    ];

    public $incrementing=false;
    
//  Field yang di sembunyikan
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function menus()
    {
        return $this->hasMany(MenusModel::class, 'menu_id', 'menu_id');
    }

}





