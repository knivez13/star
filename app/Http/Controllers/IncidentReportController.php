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
        $this->middleware('permission:View Tracker', ['only' => ['index']]);
        $this->middleware('permission:Create Tracker', ['only' => ['create', 'store', 'link']]);
        $this->middleware('permission:Update Tracker', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Tracker', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $user = Auth::user();

        $requestParams = $request->all();
        $search = Arr::get($requestParams, 'search', '');
        $property_id = Arr::get($requestParams, 'property_id', '');
        $group_section_id = Arr::get($requestParams, 'group_section_id', '');
        $department_id = Arr::get($requestParams, 'department_id', '');
        $area_id = Arr::get($requestParams, 'area_id', '');
        $location_id = Arr::get($requestParams, 'location_id', '');
        $origin_id = Arr::get($requestParams, 'origin_id', '');
        $report_status_id = Arr::get($requestParams, 'report_status_id', '');
        $list = IncidentReport::query();


        if ($user->can('Show All Department Report') || $user->can('for OP Surv')) {
        } else {
            $list->where('department_id', '=', $user->department_id);
            if ($user->can('Close For Reply')) {
                // $list->where('report_status_id', '=', ReportStatus::where('description', '=', 'Close For Reply')->first()->id);
                $list->where('for_head_reply', '=', 1);
            } else {
                // $list->where('report_status_id', '=', ReportStatus::where('description', '=', 'Pending')->first()->id);
                $list->where('for_head_reply', '=', 0);
            }
        }



        if (!empty($property_id)) {
            $list->where('property_id', '=', $property_id);
        }
        if (!empty($group_section_id)) {
            $list->where('group_section_id', '=', $group_section_id);
        }
        if (!empty($department_id)) {
            $list->where('department_id', '=', $department_id);
        }
        if (!empty($area_id)) {
            $list->where('area_id', '=', $area_id);
        }
        if (!empty($origin_id)) {
            $list->where('origin_id', '=', $origin_id);
        }
        if (!empty($report_status_id)) {
            $list->where('report_status_id', '=', $report_status_id);
        }

        if (!empty($search)) {
            $list->where('synopsis', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
            $list->orWhere('details', 'LIKE', '%' . $search . '%');
        }

        $list->sortable(['created_at' => 'desc']);
        $list->with('createdBy', 'updatedBy', 'linkReport', 'area', 'currency', 'department', 'groupSection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reportType', 'result', 'reportStatus');

        $datas = $list->paginate(10);

        $area = Area::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $department = Department::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $groupsection = GroupSection::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $location = Location::select('id', 'code', 'description')->sortable(['description' => 'desc'])->with('area')->get();
        $origination = Origination::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $property = Property::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $reportstatus = ReportStatus::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();

        return view('dashboard.tracker.index', compact('datas', 'property', 'groupsection', 'department', 'area', 'location', 'origination', 'reportstatus'));
    }

    public function create()
    {
        // $area = Area::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $currency = Currency::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $department = Department::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $groupsection = GroupSection::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $incidentTitle = IncidentTitle::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $inspector = Inspector::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $location = Location::select('id', 'code', 'description', 'area_id')->sortable(['description' => 'asc'])->with('area')->get();
        $origination = Origination::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $property = Property::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $reporttype = ReportType::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $result = Result::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $blacklist = Blacklist::get();
        $nationality = [
            'AF - Afghanistan',
            'AL - Albania',
            'DZ - Algeria',
            'AO - Angola',
            'AR - Argentina',
            'AM - Armenia',
            'AU - Australia',
            'AT - Austria',
            'BH - Bahrain',
            'BD - Bangladesh',
            'BE - Belgium',
            'BZ - Belize',
            'BT - Bhutan',
            'BO - Bolivia',
            'BR - Brazil',
            'BN - Brunei',
            'BG - Bulgaria',
            'KH - Cambodia',
            'CA - Canada',
            'CF - Central Africa Republic',
            'CL - Chile',
            'CN - China',
            'CO - Colombia',
            'CG - Congo',
            'HR - Croatia',
            'CU - Cuba',
            'CZ - Czech Republic',
            'DK - Denmark',
            'DO - Dominican Republic',
            'EC - Ecuador',
            'EG - Egypt',
            'SV - El Salvador',
            'FL - Finland',
            'FR - France',
            'DE - Germany',
            'GR - Greece',
            'GL - Greenland',
            'GU - Guam',
            'GT - Guatemala',
            'HT - Haiti',
            'HN - Honduras',
            'HK - Hong Kong',
            'HU - Hungary',
            'IS - Iceland',
            'IN - India',
            'ID - Indonesia',
            'IR - Iran',
            'IQ - Iraq',
            'IE - Ireland',
            'IL - Israel',
            'IT - Italy',
            'JM - Jamaica',
            'JP - Japan',
            'JO - Jordan',
            'KZ - Kazakhstan',
            'KE - Kenya',
            'KI - Kiribati',
            'KP - South Korea',
            'KR - North Korea',
            'KW - Kuwait',
            'KG - Kyrgyztan',
            'LA - Laos',
            'LB - Lebanon',
            'MO - Macau',
            'MY - Malaysia',
            'MV - Maldives',
            'ML - Mali',
            'MX - Mexico ',
            'MN - Mongolia',
            'MA - Morocco',
            'MM - Myanmar',
            'NP - Nepal',
            'NL - Netherlands',
            'NZ - New Zealand',
            'NI - Nicaragua',
            'NE - Niger',
            'NG - Nigeria',
            'NO - Norway',
            'OM - Oman',
            'PK - Pakistan',
            'PW - Palau',
            'PA - Panama',
            'PG - Papua New Guinea',
            'PY - Paraguay',
            'PE - Peru',
            'PH - Philippines',
            'PL - Poland',
            'PT - Portugal',
            'PR - Puerto Rico',
            'QA - Qatar',
            'RO - Romania',
            'RU - Russia',
            'SA - Saudi Arabia',
            'SG - Singapore',
            'ZA - South Africa',
            'ES - Spain',
            'LK - Sri Lanka',
            'SD - Sudan',
            'SE - Sweden',
            'CH - Switzerland',
            'TW - Taiwan',
            'TH - Thailand',
            'TR - Turkey',
            'UA - Ukraine',
            'AE - United Arab Emirates',
            'GB - United Kingdom',
            'VE - Venezuela',
            'VN - Vietnam',
            'YE - Yemen',
            'ZW - Zimbabwe',
            'UN - Unidentified',
        ];
        return view('dashboard.tracker.create', compact('blacklist', 'nationality', 'currency', 'department', 'groupsection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reporttype', 'result'));
        // return view('dashboard.tracker.create', compact('blacklist', 'area', 'currency', 'department', 'groupsection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reporttype', 'result'));
    }

    public function link($id)
    {
        $currency = Currency::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $department = Department::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $groupsection = GroupSection::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $incidentTitle = IncidentTitle::select('id', 'code', 'description', 'department_id')->sortable(['description' => 'asc'])->with('department')->get();
        $inspector = Inspector::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $location = Location::select('id', 'code', 'description', 'area_id')->sortable(['description' => 'asc'])->with('area')->get();
        $origination = Origination::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $property = Property::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $reporttype = ReportType::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $result = Result::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $blacklist = Blacklist::get();
        $nationality = [
            'AF - Afghanistan',
            'AL - Albania',
            'DZ - Algeria',
            'AO - Angola',
            'AR - Argentina',
            'AM - Armenia',
            'AU - Australia',
            'AT - Austria',
            'BH - Bahrain',
            'BD - Bangladesh',
            'BE - Belgium',
            'BZ - Belize',
            'BT - Bhutan',
            'BO - Bolivia',
            'BR - Brazil',
            'BN - Brunei',
            'BG - Bulgaria',
            'KH - Cambodia',
            'CA - Canada',
            'CF - Central Africa Republic',
            'CL - Chile',
            'CN - China',
            'CO - Colombia',
            'CG - Congo',
            'HR - Croatia',
            'CU - Cuba',
            'CZ - Czech Republic',
            'DK - Denmark',
            'DO - Dominican Republic',
            'EC - Ecuador',
            'EG - Egypt',
            'SV - El Salvador',
            'FL - Finland',
            'FR - France',
            'DE - Germany',
            'GR - Greece',
            'GL - Greenland',
            'GU - Guam',
            'GT - Guatemala',
            'HT - Haiti',
            'HN - Honduras',
            'HK - Hong Kong',
            'HU - Hungary',
            'IS - Iceland',
            'IN - India',
            'ID - Indonesia',
            'IR - Iran',
            'IQ - Iraq',
            'IE - Ireland',
            'IL - Israel',
            'IT - Italy',
            'JM - Jamaica',
            'JP - Japan',
            'JO - Jordan',
            'KZ - Kazakhstan',
            'KE - Kenya',
            'KI - Kiribati',
            'KP - South Korea',
            'KR - North Korea',
            'KW - Kuwait',
            'KG - Kyrgyztan',
            'LA - Laos',
            'LB - Lebanon',
            'MO - Macau',
            'MY - Malaysia',
            'MV - Maldives',
            'ML - Mali',
            'MX - Mexico ',
            'MN - Mongolia',
            'MA - Morocco',
            'MM - Myanmar',
            'NP - Nepal',
            'NL - Netherlands',
            'NZ - New Zealand',
            'NI - Nicaragua',
            'NE - Niger',
            'NG - Nigeria',
            'NO - Norway',
            'OM - Oman',
            'PK - Pakistan',
            'PW - Palau',
            'PA - Panama',
            'PG - Papua New Guinea',
            'PY - Paraguay',
            'PE - Peru',
            'PH - Philippines',
            'PL - Poland',
            'PT - Portugal',
            'PR - Puerto Rico',
            'QA - Qatar',
            'RO - Romania',
            'RU - Russia',
            'SA - Saudi Arabia',
            'SG - Singapore',
            'ZA - South Africa',
            'ES - Spain',
            'LK - Sri Lanka',
            'SD - Sudan',
            'SE - Sweden',
            'CH - Switzerland',
            'TW - Taiwan',
            'TH - Thailand',
            'TR - Turkey',
            'UA - Ukraine',
            'AE - United Arab Emirates',
            'GB - United Kingdom',
            'VE - Venezuela',
            'VN - Vietnam',
            'YE - Yemen',
            'ZW - Zimbabwe',
            'UN - Unidentified',
        ];
        $link = IncidentReport::where('id', '=', $id)->first();
        $blacklist = Blacklist::get();

        return view('dashboard.tracker.link', compact('blacklist', 'nationality', 'link', 'currency', 'department',  'groupsection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reporttype', 'result'));
    }

    public function store(Request $request)
    {
        DB::transaction(
            function () use ($request) {
                $this->validate($request, [
                    'property_id' => 'required',
                    'group_section_id' => 'required',
                    'location_id' => 'required',
                    'event_date' => 'required',
                    'report_type_id' => 'required',
                    'department_id' => 'required',
                    'incident_title_id' => 'required',
                    'origin_id' => 'required',
                    'result_id' => 'required',
                    'details' => 'required',
                    'action_taken' => 'required',
                ]);
                $year = Carbon::now()->format('Y');
                $total = IncidentReport::whereYear('created_at', Carbon::now())->get()->count();
                $property = Property::where('id', '=', $request->property_id)->first()->code;
                $groupsection = GroupSection::where('id', '=', $request->group_section_id)->first()->code;
                $area_id = Location::where('id', '=', $request->location_id)->first()->area_id;

                $input = Arr::only($request->all(), ['property_id', 'group_section_id', 'link_report', 'location_id', 'description', 'department_id', 'event_date', 'report_type_id', 'incident_title_id', 'origin_id', 'result_id', 'currency_id', 'total_value', 'details', 'action_taken', 'inspector_id', 'verified_by']);
                $input['synopsis'] = $year . '/' . $property . '/' . $groupsection . '/' . sprintf("%05d", $total + 1);
                $input['area_id'] = $area_id;
                $input['created_by'] = Auth::user()->id;
                $input['report_status_id'] = ReportStatus::where('description', '=', 'Pending')->first()->id;
                $in = IncidentReport::create($input);


                if (count($request->blacklist['first_name']) > 0) {
                    for ($x = 0; $x < count($request->blacklist['type']); $x++) {
                        IncidentBlacklist::create([
                            'type' => $request->blacklist['type'][$x],
                            'member_id' => $request->blacklist['member_id'][$x],
                            'first_name' => $request->blacklist['first_name'][$x],
                            'last_name' => $request->blacklist['last_name'][$x],
                            'nationality' => $request->blacklist['nationality'][$x],
                            'barred' => $request->blacklist['barred'][$x] == 'NO' ? false : true,
                            'initiator' => $request->blacklist['initiator'][$x] == 'NO' ? false : true,
                            'incident_report_id' => $in->id,
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
        $incidentBlacklist = IncidentBlacklist::where('incident_report_id', '=', $id)->get();
        return view('dashboard.tracker.show', compact('data', 'incidentBlacklist'));
    }
    public function edit($id)
    {
        $currency = Currency::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $department = Department::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $groupsection = GroupSection::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $incidentTitle = IncidentTitle::select('id', 'code', 'description', 'department_id')->sortable(['description' => 'asc'])->with('department')->get();
        $inspector = Inspector::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $location = Location::select('id', 'code', 'description', 'area_id')->sortable(['description' => 'asc'])->with('area')->get();
        $origination = Origination::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $property = Property::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $reporttype = ReportType::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $result = Result::select('id', 'code', 'description')->sortable(['description' => 'asc'])->get();
        $nationality = [
            'AF - Afghanistan',
            'AL - Albania',
            'DZ - Algeria',
            'AO - Angola',
            'AR - Argentina',
            'AM - Armenia',
            'AU - Australia',
            'AT - Austria',
            'BH - Bahrain',
            'BD - Bangladesh',
            'BE - Belgium',
            'BZ - Belize',
            'BT - Bhutan',
            'BO - Bolivia',
            'BR - Brazil',
            'BN - Brunei',
            'BG - Bulgaria',
            'KH - Cambodia',
            'CA - Canada',
            'CF - Central Africa Republic',
            'CL - Chile',
            'CN - China',
            'CO - Colombia',
            'CG - Congo',
            'HR - Croatia',
            'CU - Cuba',
            'CZ - Czech Republic',
            'DK - Denmark',
            'DO - Dominican Republic',
            'EC - Ecuador',
            'EG - Egypt',
            'SV - El Salvador',
            'FL - Finland',
            'FR - France',
            'DE - Germany',
            'GR - Greece',
            'GL - Greenland',
            'GU - Guam',
            'GT - Guatemala',
            'HT - Haiti',
            'HN - Honduras',
            'HK - Hong Kong',
            'HU - Hungary',
            'IS - Iceland',
            'IN - India',
            'ID - Indonesia',
            'IR - Iran',
            'IQ - Iraq',
            'IE - Ireland',
            'IL - Israel',
            'IT - Italy',
            'JM - Jamaica',
            'JP - Japan',
            'JO - Jordan',
            'KZ - Kazakhstan',
            'KE - Kenya',
            'KI - Kiribati',
            'KP - South Korea',
            'KR - North Korea',
            'KW - Kuwait',
            'KG - Kyrgyztan',
            'LA - Laos',
            'LB - Lebanon',
            'MO - Macau',
            'MY - Malaysia',
            'MV - Maldives',
            'ML - Mali',
            'MX - Mexico ',
            'MN - Mongolia',
            'MA - Morocco',
            'MM - Myanmar',
            'NP - Nepal',
            'NL - Netherlands',
            'NZ - New Zealand',
            'NI - Nicaragua',
            'NE - Niger',
            'NG - Nigeria',
            'NO - Norway',
            'OM - Oman',
            'PK - Pakistan',
            'PW - Palau',
            'PA - Panama',
            'PG - Papua New Guinea',
            'PY - Paraguay',
            'PE - Peru',
            'PH - Philippines',
            'PL - Poland',
            'PT - Portugal',
            'PR - Puerto Rico',
            'QA - Qatar',
            'RO - Romania',
            'RU - Russia',
            'SA - Saudi Arabia',
            'SG - Singapore',
            'ZA - South Africa',
            'ES - Spain',
            'LK - Sri Lanka',
            'SD - Sudan',
            'SE - Sweden',
            'CH - Switzerland',
            'TW - Taiwan',
            'TH - Thailand',
            'TR - Turkey',
            'UA - Ukraine',
            'AE - United Arab Emirates',
            'GB - United Kingdom',
            'VE - Venezuela',
            'VN - Vietnam',
            'YE - Yemen',
            'ZW - Zimbabwe',
            'UN - Unidentified',
        ];
        $incidentBlacklist = IncidentBlacklist::where('incident_report_id', '=', $id)->get();

        $data = IncidentReport::find($id);
        return view('dashboard.tracker.edit', compact('incidentBlacklist', 'data', 'nationality', 'department',  'currency',  'groupsection', 'incidentTitle', 'inspector', 'location', 'origination', 'property', 'reporttype', 'result'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(
            function () use ($request, $id) {
                $this->validate($request, [
                    'property_id' => 'required',
                    'group_section_id' => 'required',
                    'location_id' => 'required',
                    'event_date' => 'required',
                    'report_type_id' => 'required',
                    'incident_title_id' => 'required',
                    'origin_id' => 'required',
                    'result_id' => 'required',
                    'details' => 'required',
                    'action_taken' => 'required',
                ]);

                $input = Arr::only($request->all(), ['property_id', 'group_section_id', 'link_report', 'area_id', 'location_id', 'description', 'event_date', 'department_id', 'report_type_id', 'incident_title_id', 'origin_id', 'result_id', 'currency_id', 'total_value', 'details', 'action_taken', 'inspector_id', 'verified_by']);
                $input['updated_by'] = Auth::user()->id;
                IncidentReport::find($id)->update($input);
                if (count($request->blacklist['first_name']) > 0) {
                    IncidentBlacklist::where('incident_report_id', '=', $id)->delete();
                    for ($x = 0; $x < count($request->blacklist['type']); $x++) {
                        IncidentBlacklist::create([
                            'type' => $request->blacklist['type'][$x],
                            'member_id' => $request->blacklist['member_id'][$x],
                            'first_name' => $request->blacklist['first_name'][$x],
                            'last_name' => $request->blacklist['last_name'][$x],
                            'nationality' => $request->blacklist['nationality'][$x],
                            'barred' => $request->blacklist['barred'][$x] == 'NO' ? false : true,
                            'initiator' => $request->blacklist['initiator'][$x] == 'NO' ? false : true,
                            'incident_report_id' => $id,
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

    public function closereply($id)
    {
        IncidentReport::find($id)->update([
            'report_status_id' => ReportStatus::where('description', '=', 'Close For Reply')->first()->id,
            'for_head_reply' => 1
        ]);
        return redirect(route('tracker.index'))->with('success', 'Delete successfully');
    }

    public function returnHead($id)
    {
        IncidentReport::find($id)->update([
            'report_status_id' => ReportStatus::where('description', '=', 'Reply Done')->first()->id,
            'for_head_reply' => 0
        ]);
        return redirect(route('tracker.index'))->with('success', 'Delete successfully');
    }

    public function void($id)
    {
        IncidentReport::find($id)->update([
            'report_status_id' => ReportStatus::where('description', '=', 'Void')->first()->id,
            'for_head_reply' => 0
        ]);
        return redirect(route('tracker.index'))->with('success', 'Delete successfully');
    }
    public function totalclose($id)
    {
        IncidentReport::find($id)->update([
            'report_status_id' => ReportStatus::where('description', '=', 'Total Close')->first()->id,
            'for_head_reply' => 0
        ]);
        return redirect(route('tracker.index'))->with('success', 'Delete successfully');
    }
}
