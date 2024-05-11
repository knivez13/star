<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Uuids;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Maintenance\Origination;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance\GroupSection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BriefingLogs extends Model
{
    use HasFactory, Uuids, SoftDeletes, Sortable;
    protected $guarded = [];

    public function origination()
    {
        return $this->belongsTo(Origination::class, 'origination_id');
    }

    public function groupSection()
    {
        return $this->belongsTo(GroupSection::class, 'group_section_id');
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
