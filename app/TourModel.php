<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class TourModel extends Model
{
    protected $table = 'tour';
    protected $primaryKey = 'tour_id';
}
