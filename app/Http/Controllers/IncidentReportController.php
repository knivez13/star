<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blacklist;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\IncidentReport;
use App\Models\Maintenance\Area;
use App\Models\IncidentBlacklist;
use App\Models\Maintenance\Result;
use Illuminate\Support\Facades\DB;
use App\Models\Maintenance\Currency;
use App\Models\Maintenance\Location;
use App\Models\Maintenance\Property;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance\Inspector;
use App\Models\Maintenance\Department;
use App\Models\Maintenance\ReportType;
use App\Models\Maintenance\Origination;
use App\Models\Maintenance\GroupSection;
use App\Models\Maintenance\ReportStatus;
use App\Models\Maintenance\IncidentTitle;

class IncidentReportController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:view-maintenance-business-units-list', ['only' => ['index']]);
        // $this->middleware('permission:view-maintenance-business-units-add', ['only' => ['create', 'store']]);
        // $this->middleware('permission:view-maintenance-business-units-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:view-maintenance-business-units-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $requestParams = $request->all();
        $search = Arr::get($requestParams, 'search', '');
        $list = IncidentReport::query();
        if (!empty($search)) {
            $list->where('synopsis', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
            $list->orWhere('details', 'LIKE', '%' . $search . '%');
        }
        $list->sortable(['created_at' => 'desc']);
        $list->with('createdBy', 'updatedBy', 'linkReport', 'area', 'currency', 'department', 'groupSection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reportType', 'result', 'reportStatus');

        $datas = $list->paginate(10);
        return view('dashboard.tracker.index', compact('datas'));
    }

    public function create()
    {
        $area = Area::select('id', 'code', 'description')->get();
        $currency = Currency::select('id', 'code', 'description')->get();
        $department = Department::select('id', 'code', 'description')->get();
        $groupsection = GroupSection::select('id', 'code', 'description')->get();
        $incidentTitle = IncidentTitle::select('id', 'code', 'description')->get();
        $inspector = Inspector::select('id', 'code', 'description')->get();
        $location = Location::select('id', 'code', 'description')->get();
        $origination = Origination::select('id', 'code', 'description')->get();
        $property = Property::select('id', 'code', 'description')->get();
        $reporttype = ReportType::select('id', 'code', 'description')->get();
        $result = Result::select('id', 'code', 'description')->get();
        $blacklist = Blacklist::get();
        return view('dashboard.tracker.create', compact('blacklist', 'area', 'currency', 'department', 'groupsection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reporttype', 'result'));
    }

    public function link($id)
    {
        $area = Area::select('id', 'code', 'description')->get();
        $currency = Currency::select('id', 'code', 'description')->get();
        $department = Department::select('id', 'code', 'description')->get();
        $groupsection = GroupSection::select('id', 'code', 'description')->get();
        $incidentTitle = IncidentTitle::select('id', 'code', 'description')->get();
        $inspector = Inspector::select('id', 'code', 'description')->get();
        $location = Location::select('id', 'code', 'description')->get();
        $origination = Origination::select('id', 'code', 'description')->get();
        $property = Property::select('id', 'code', 'description')->get();
        $reporttype = ReportType::select('id', 'code', 'description')->get();
        $result = Result::select('id', 'code', 'description')->get();
        $link = IncidentReport::where('id', '=', $id)->first();
        $blacklist = Blacklist::get();

        return view('dashboard.tracker.link', compact('blacklist', 'area', 'link', 'currency', 'department', 'groupsection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reporttype', 'result'));
    }

    public function store(Request $request)
    {
        DB::transaction(
            function () use ($request) {
                $this->validate($request, [
                    'property_id' => 'required',
                    'group_section_id' => 'required',
                    'area_id' => 'required',
                    'location_id' => 'required',
                    'event_date' => 'required',
                    'department_id' => 'required',
                    'report_type_id' => 'required',
                    'incident_title_id' => 'required',
                    'origin_id' => 'required',
                    'result_id' => 'required',
                    'details' => 'required',
                    'action_taken' => 'required',
                    'inspector_id' => 'required',
                ]);
                $year = Carbon::now()->format('Y');
                $total = IncidentReport::whereYear('created_at', Carbon::now())->get()->count();
                $property = Property::where('id', '=', $request->property_id)->first()->code;
                $groupsection = GroupSection::where('id', '=', $request->group_section_id)->first()->code;

                $input = Arr::only($request->all(), ['property_id', 'group_section_id', 'link_report', 'area_id', 'location_id', 'description', 'event_date', 'department_id', 'report_type_id', 'incident_title_id', 'origin_id', 'result_id', 'currency_id', 'total_value', 'details', 'action_taken', 'inspector_id', 'verified_by']);
                $input['synopsis'] = $year . '/' . $property . '/' . $groupsection . '/' . sprintf("%05d", $total + 1);
                $input['created_by'] = Auth::user()->id;
                $input['report_status_id'] = ReportStatus::where('description', '=', 'Pending')->first()->id;
                $ir = IncidentReport::create($input);
                $input2 = Arr::only($request->all(), ['blacklist']);

                if (!empty($input2['blacklist'])) {
                    foreach ($input2['blacklist'] as $q) {
                        IncidentBlacklist::create([
                            'blacklist_id' => $q,
                            'incident_report_id' => $ir->id
                        ]);
                    }
                }
            }
        );

        return redirect(route('tracker.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        $data = IncidentReport::where('id', '=', $id)->first();
        $incidentBlacklist = IncidentBlacklist::where('incident_report_id', '=', $id)->with('blacklist')->get();
        return view('dashboard.tracker.show', compact('data', 'incidentBlacklist'));
    }
    public function edit($id)
    {
        $area = Area::select('id', 'code', 'description')->get();
        $currency = Currency::select('id', 'code', 'description')->get();
        $department = Department::select('id', 'code', 'description')->get();
        $groupsection = GroupSection::select('id', 'code', 'description')->get();
        $incidentTitle = IncidentTitle::select('id', 'code', 'description')->get();
        $inspector = Inspector::select('id', 'code', 'description')->get();
        $location = Location::select('id', 'code', 'description')->get();
        $origination = Origination::select('id', 'code', 'description')->get();
        $property = Property::select('id', 'code', 'description')->get();
        $reporttype = ReportType::select('id', 'code', 'description')->get();
        $result = Result::select('id', 'code', 'description')->get();
        $blacklist = Blacklist::get();
        $incidentBlacklist = IncidentBlacklist::where('incident_report_id', '=', $id)->get()->pluck('blacklist_id');

        $data = IncidentReport::find($id);
        return view('dashboard.tracker.edit', compact('blacklist', 'incidentBlacklist', 'data', 'area',  'currency', 'department', 'groupsection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reporttype', 'result'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(
            function () use ($request, $id) {
                $this->validate($request, [
                    'property_id' => 'required',
                    'group_section_id' => 'required',
                    'area_id' => 'required',
                    'location_id' => 'required',
                    'event_date' => 'required',
                    'department_id' => 'required',
                    'report_type_id' => 'required',
                    'incident_title_id' => 'required',
                    'origin_id' => 'required',
                    'result_id' => 'required',
                    'details' => 'required',
                    'action_taken' => 'required',
                    'inspector_id' => 'required',
                ]);

                $input = Arr::only($request->all(), ['property_id', 'group_section_id', 'link_report', 'area_id', 'location_id', 'description', 'event_date', 'department_id', 'report_type_id', 'incident_title_id', 'origin_id', 'result_id', 'currency_id', 'total_value', 'details', 'action_taken', 'inspector_id', 'verified_by']);
                $input['updated_by'] = Auth::user()->id;
                IncidentReport::find($id)->update($input);
                $input2 = Arr::only($request->all(), ['blacklist']);

                if (!empty($input2['blacklist'])) {
                    IncidentBlacklist::where('incident_report_id', '=', $id)->delete();
                    foreach ($input2['blacklist'] as $q) {
                        IncidentBlacklist::create([
                            'blacklist_id' => $q,
                            'incident_report_id' => $id
                        ]);
                    }
                }
            }
        );
        return redirect(route('tracker.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        IncidentReport::find($id)->delete();
        return redirect(route('tracker.index'))->with('success', 'Delete successfully');
    }
}
