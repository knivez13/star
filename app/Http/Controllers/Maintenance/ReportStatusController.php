<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance\ReportStatus;

class ReportStatusController extends Controller
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
        $list = ReportStatus::query();
        if (!empty($search)) {
            $list->where('code', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
        }
        $list->sortable('code');
        $list->with('createdBy', 'updatedBy');

        $datas = $list->paginate(10);
        return view('dashboard.maintenance.report-status.index', compact('datas'));
    }

    public function create()
    {
        return view('dashboard.maintenance.report-status.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:report_statuses,code',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['created_by'] = Auth::user()->id;
        ReportStatus::create($input);
        return redirect(route('report-status.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = ReportStatus::find($id);
        return view('dashboard.maintenance.report-status.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:report_statuses,code,' . $id,
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['updated_by'] = Auth::user()->id;
        ReportStatus::find($id)->update($input);
        return redirect(route('report-status.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        ReportStatus::find($id)->delete();
        return redirect(route('report-status.index'))->with('success', 'Delete successfully');
    }
}
