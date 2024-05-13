<?php

namespace App\Models;

use App\Traits\Uuids;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncidentBlacklist extends Model
{
    use HasFactory, Uuids, Sortable;
    protected $guarded = [];

    public function incidentReport()
    {
        return $this->belongsTo(IncidentReport::class, 'incident_report_id', 'id');
    }

    public function blacklist()
    {
        return $this->belongsTo(Blacklist::class, 'blacklist_id', 'id');
    }
}
