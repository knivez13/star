<?php

namespace App\Models;

use App\Traits\Uuids;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Blacklist\BlackistType;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blacklist\BlackistStatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blacklist extends Model
{
    use HasFactory, Uuids, SoftDeletes, Sortable;
    protected $guarded = [];

    public function blackistType()
    {
        return $this->belongsTo(BlackistType::class, 'blackist_type_id');
    }
    public function blackistStatus()
    {
        return $this->belongsTo(BlackistStatus::class, 'blackist_status_id');
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
