<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance\ReportType;

class ReportTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:View Maintenance', ['only' => ['index']]);
        $this->middleware('permission:Create Maintenance', ['only' => ['create', 'store']]);
        $this->middleware('permission:Update Maintenance', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Maintenance', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $requestParams = $request->all();
        $search = Arr::get($requestParams, 'search', '');
        $list = ReportType::query();
        if (!empty($search)) {
            $list->where('code', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
        }
        $list->sortable('code');
        $list->with('createdBy', 'updatedBy');

        $datas = $list->paginate(10);
        return view('dashboard.maintenance.report-type.index', compact('datas'));
    }

    public function create()
    {
        return view('dashboard.maintenance.report-type.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:report_types,code',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['created_by'] = Auth::user()->id;
        ReportType::create($input);
        return redirect(route('report-type.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = ReportType::find($id);
        return view('dashboard.maintenance.report-type.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:report_types,code,' . $id,
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['updated_by'] = Auth::user()->id;
        ReportType::find($id)->update($input);
        return redirect(route('report-type.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        ReportType::find($id)->delete();
        return redirect(route('report-type.index'))->with('success', 'Delete successfully');
    }
}
