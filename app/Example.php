<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Example extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'example_id',
        'example_name',
        'example_phone'
    ];

    protected $primaryKey = 'example_id';

    protected $keyType = 'string';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
