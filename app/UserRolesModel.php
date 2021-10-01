<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRolesModel extends Model
{
    //    Soft Delete
    use softDeletes;

//    Nama Table
    protected $table = "user_roles";

//    Nama Primary Key
    protected $primaryKey = "user_roles_id";

//    Field yang bisa di isi
    protected $fillable = [
        "user_roles_name",
        "user_roles_status"
    ];

    public $incrementing=false;
    
//  Field yang di sembunyikan
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
