<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProvinceModel extends Model
{
    use SoftDeletes;
    protected $table = 'provinces';
    protected $guarded = [];
}
