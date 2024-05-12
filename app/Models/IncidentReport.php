<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Uuids;
use App\Models\Maintenance\Area;
use App\Models\Maintenance\Result;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Maintenance\Currency;
use App\Models\Maintenance\Location;
use App\Models\Maintenance\Property;
use App\Models\Maintenance\Inspector;
use App\Models\Maintenance\Department;
use App\Models\Maintenance\ReportType;
use App\Models\Maintenance\Origination;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance\GroupSection;
use App\Models\Maintenance\ReportStatus;
use App\Models\Maintenance\IncidentTitle;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncidentReport extends Model
{
    use HasFactory, Uuids, SoftDeletes, Sortable;
    protected $guarded = [];

    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id')->select('id', 'code', 'description');
    }

    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id')->select('id', 'code', 'description');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id')->select('id', 'code', 'description');
    }

    public function groupSection()
    {
        return $this->hasOne(GroupSection::class, 'id', 'group_section_id')->select('id', 'code', 'description');
    }

    public function incidentTitle()
    {
        return $this->hasOne(IncidentTitle::class, 'id', 'incident_title_id')->select('id', 'code', 'description');
    }

    public function inspector()
    {
        return $this->hasOne(Inspector::class, 'id', 'inspector_id')->select('id', 'code', 'description');
    }

    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id')->select('id', 'code', 'description');
    }

    public function origination()
    {
        return $this->hasOne(Origination::class, 'id', 'origin_id')->select('id', 'code', 'description');
    }

    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'property_id')->select('id', 'code', 'description');
    }

    public function reportType()
    {
        return $this->hasOne(ReportType::class, 'id', 'report_type_id')->select('id', 'code', 'description');
    }

    public function result()
    {
        return $this->hasOne(Result::class, 'id', 'result_id')->select('id', 'code', 'description');
    }

    public function reportStatus()
    {
        return $this->hasOne(ReportStatus::class, 'id', 'report_status_id')->select('id', 'code', 'description');
    }

    public function linkReport()
    {
        return $this->hasOne(IncidentReport::class, 'id', 'link_report')->select('id', 'synopsis');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->select('id', 'first_name', 'middle_name', 'last_name');
    }
    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by')->select('id', 'first_name', 'middle_name', 'last_name');
    }
}
