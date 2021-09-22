<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeModel extends Model
{
    //    Soft Delete
    use softDeletes;

//    Nama Table
    protected $table = "employee";

//    Nama Primary Key
    protected $primaryKey = "employee_id";

//    Field yang bisa di isi
    protected $fillable = [
        "user_role_id",
        "employee_firstname",
        "employee_secondname",
        "employee_lastname",
        "employee_password",
        "employee_email",
        "employee_status",
        "employee_image"
    ];

//  Field yang di sembunyikan
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
