<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Models\BriefingLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance\Origination;
use App\Models\Maintenance\GroupSection;

class BriefingLogsController extends Controller
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
        $group_section_id = Arr::get($requestParams, 'group_section_id', '');
        $origination_id = Arr::get($requestParams, 'origination_id', '');
        $date_search = Arr::get($requestParams, 'date_search', '');
        $list = BriefingLogs::query();
        if (!empty($date_search)) {
            $list->whereDate('created_at', '=', $date_search);
        }
        if (!empty($search)) {
            $list->where('description', 'LIKE', '%' . $search . '%');
            $list->orWhere('inv_no', 'LIKE', '%' . $search . '%');
        }
        if (!empty($group_section_id)) {
            $list->where('group_section_id', '=', $group_section_id);
        }
        if (!empty($origination_id)) {
            $list->where('origination_id', '=', $origination_id);
        }
        $list->sortable(['created_at' => 'desc']);
        $list->with('createdBy', 'updatedBy', 'groupSection', 'origination');
        $datas = $list->paginate(10);
        $origin = Origination::get();
        $group_section = GroupSection::get();
        return view('dashboard.briefing-logs.index', compact('datas', 'group_section', 'origin'));
    }

    public function create()
    {
        $origin = Origination::get();
        $group_section = GroupSection::get();
        return view('dashboard.briefing-logs.create', compact('group_section', 'origin'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'origination_id' => 'required',
            'group_section_id' => 'required',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['origination_id', 'group_section_id', 'description']);
        $input['inv_no'] = 'BL-' . sprintf("%09d", BriefingLogs::where('origination_id', '=', $input['origination_id'])->where('group_section_id', '=', $input['group_section_id'])->count() + 1);
        $input['created_by'] = Auth::user()->id;
        BriefingLogs::create($input);
        return redirect(route('briefing-logs.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $origin = Origination::get();
        $group_section = GroupSection::get();
        $data = BriefingLogs::find($id);
        return view('dashboard.briefing-logs.edit', compact('data', 'origin', 'group_section'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'origination_id' => 'required',
            'group_section_id' => 'required',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['origination_id', 'group_section_id', 'description']);
        $input['updated_by'] = Auth::user()->id;
        BriefingLogs::find($id)->update($input);
        return redirect(route('briefing-logs.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        BriefingLogs::find($id)->delete();
        return redirect(route('briefing-logs.index'))->with('success', 'Delete successfully');
    }
}
