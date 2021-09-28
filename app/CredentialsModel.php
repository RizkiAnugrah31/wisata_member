<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CredentialsModels extends Model
{
    //    Soft Delete
    use softDeletes;

//    Nama Table
    protected $table = "employee";

//    Nama Primary Key
    protected $primaryKey = "employee_id";

//    Field yang bisa di isi
    protected $fillable = [
        "platform",
        "client_key",
        "secret_key"
    ];

//  Field yang di sembunyikan
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
