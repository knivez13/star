<?php

namespace App\Http\Controllers;

use App\Models\Blacklist;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlacklistController extends Controller
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
        $list = Blacklist::query();
        if (!empty($search)) {
            $list->where('description', 'LIKE', '%' . $search . '%');
        }
        $list->sortable('code');
        $list->with('createdBy', 'updatedBy');

        $datas = $list->paginate(10);
        return view('maintenance.business-unit.index', compact('datas'));
    }

    public function create()
    {
        return view('maintenance.business-unit.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:user_levels,code',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['created_by'] = Auth::user()->id;
        Blacklist::create($input);
        return redirect(route('business-unit.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Blacklist::find($id);
        return view('maintenance.business-unit.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:user_levels,code,' . $id,
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['updated_by'] = Auth::user()->id;
        Blacklist::find($id)->update($input);
        return redirect(route('business-unit.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        Blacklist::find($id)->delete();
        return redirect(route('business-unit.index'))->with('success', 'Delete successfully');
    }
}
