<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenusModel extends Model {
    //    Soft Delete
    use softDeletes;
   

//    Nama Table
    protected $table = "menus";

//    Nama Primary Key
    protected $primaryKey = "menu_id";

//    Field yang bisa di isi
    protected $fillable = [
       "name",
       "sequence",
       "url"
    ];

    public $incrementing=false;
    
//  Field yang di sembunyikan
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    

}





