<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmployeeModel extends Model {
    //    Soft Delete
    use softDeletes;
   

//    Nama Table
    protected $table = "employee";

//    Nama Primary Key
    protected $primaryKey = "employee_id";

    protected $keyType = 'string';

//    Field yang bisa di isi
    protected $fillable = [
        "user_roles_id",
        "employee_firstname",
        "employee_middlename",
        "employee_lastname",
        "employee_username",
        "employee_password",
        "employee_email",
        "employee_status",
        "employee_image",
        "created_by",
        "update_by"
    ];

    public $incrementing=false;
    
//  Field yang di sembunyikan
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
