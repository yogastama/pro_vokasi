<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProVokasiServiceModel extends Model
{
    use SoftDeletes;
    protected $table = 'pro_vokasi_services';
    protected $guarded = [];
}
