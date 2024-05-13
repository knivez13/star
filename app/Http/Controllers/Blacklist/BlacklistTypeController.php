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
        $this->middleware('permission:View Blacklist Setting', ['only' => ['index']]);
        $this->middleware('permission:Create Blacklist Setting', ['only' => ['create', 'store']]);
        $this->middleware('permission:Update Blacklist Setting', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Blacklist Setting', ['only' => ['destroy']]);
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
        return view('dashboard.blacklist-maintenance.blacklist-type.index', compact('datas'));
    }

    public function create()
    {
        return view('dashboard.blacklist-maintenance.blacklist-type.create');
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
        return redirect(route('blacklist-type.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = BlackistType::find($id);
        return view('dashboard.blacklist-maintenance.blacklist-type.edit', compact('data'));
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
        return redirect(route('blacklist-type.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        BlackistType::find($id)->delete();
        return redirect(route('blacklist-type.index'))->with('success', 'Delete successfully');
    }
}
