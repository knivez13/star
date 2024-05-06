<?php

namespace App\Http\Controllers\Blacklist;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist\BlackistType;

class BlacklistTypeController extends Controller
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
        $list = BlackistType::query();
        if (!empty($search)) {
            $list->where('code', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
        }
        $list->sortable('code');
        $list->with('createdBy', 'updatedBy');

        $datas = $list->paginate(10);
        return view('dashboard.maintenance.area.index', compact('datas'));
    }

    public function create()
    {
        return view('dashboard.maintenance.area.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:areas,code',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['created_by'] = Auth::user()->id;
        BlackistType::create($input);
        return redirect(route('area.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = BlackistType::find($id);
        return view('dashboard.maintenance.area.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:areas,code,' . $id,
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['updated_by'] = Auth::user()->id;
        BlackistType::find($id)->update($input);
        return redirect(route('area.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        BlackistType::find($id)->delete();
        return redirect(route('area.index'))->with('success', 'Delete successfully');
    }
}
