<?php

namespace App\Http\Controllers;

use App\Models\DailyLogs;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance\Origination;
use App\Models\Maintenance\GroupSection;

class DailyLogsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:View Daily Logs', ['only' => ['index']]);
        $this->middleware('permission:Create Daily Logs', ['only' => ['create', 'store']]);
        $this->middleware('permission:Update Daily Logs', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Daily Logs', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $requestParams = $request->all();
        $search = Arr::get($requestParams, 'search', '');
        $group_section_id = Arr::get($requestParams, 'group_section_id', '');
        $origination_id = Arr::get($requestParams, 'origination_id', '');
        $date_search = Arr::get($requestParams, 'date_search', '');
        $list = DailyLogs::query();
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
        return view('dashboard.daily-logs.index', compact('datas', 'group_section', 'origin'));
    }

    public function create()
    {
        $origin = Origination::get();
        $group_section = GroupSection::get();
        return view('dashboard.daily-logs.create', compact('group_section', 'origin'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'origination_id' => 'required',
            'group_section_id' => 'required',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['origination_id', 'group_section_id', 'description']);
        $input['inv_no'] = 'DL-' . sprintf("%09d", DailyLogs::where('origination_id', '=', $input['origination_id'])->where('group_section_id', '=', $input['group_section_id'])->count() + 1);
        $input['created_by'] = Auth::user()->id;
        DailyLogs::create($input);
        return redirect(route('daily-logs.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $origin = Origination::get();
        $group_section = GroupSection::get();
        $data = DailyLogs::find($id);
        return view('dashboard.daily-logs.edit', compact('data', 'origin', 'group_section'));
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
        DailyLogs::find($id)->update($input);
        return redirect(route('daily-logs.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        DailyLogs::find($id)->delete();
        return redirect(route('daily-logs.index'))->with('success', 'Delete successfully');
    }
}
