<?php

namespace App\Models\Maintenance;

use App\Models\User;
use App\Traits\Uuids;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory, Uuids, SoftDeletes, Sortable;
    protected $guarded = [];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id')->select('id', 'code', 'description');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'first_name', 'middle_name', 'last_name');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'first_name', 'middle_name', 'last_name');
    }
}
