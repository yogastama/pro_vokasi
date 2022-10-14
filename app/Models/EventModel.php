<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventModel extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    protected $guarded = [];
    public function category_event()
    {
        return $this->hasOne(EventCategoryModel::class, 'id', 'category_event_id');
    }
}
