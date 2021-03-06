<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuGroupsModel extends Model {
    //    Soft Delete
    use softDeletes;
   

//    Nama Table
    protected $table = "menu_groups";

//    Nama Primary Key
    protected $primaryKey = "menu_group_id";

    protected $keyType = 'string';
    
//    Field yang bisa di isi
    protected $fillable = [
        "menu_id",
        "name",
        "sequence",
        "icon"
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





