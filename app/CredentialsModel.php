<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CredentialsModel extends Model
{
    //    Soft Delete
    use softDeletes;

//    Nama Table
    protected $table = "credentials";

//    Nama Primary Key
    protected $primaryKey = "credential_id";

//    Field yang bisa di isi
    protected $fillable = [
        "platform",
        "client_key",
        "secret_key"
    ];

    public $incrementing=false;

//  Field yang di sembunyikan
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
