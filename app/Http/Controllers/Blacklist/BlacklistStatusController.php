<?php

namespace App\Http\Controllers\Blacklist;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist\BlackistStatus;

class BlacklistStatusController extends Controller
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
        $list = BlackistStatus::query();
        if (!empty($search)) {
            $list->where('code', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
        }
        $list->sortable('code');
        $list->with('createdBy', 'updatedBy');

        $datas = $list->paginate(10);
        return view('dashboard.blacklist-maintenance.blacklist-status.index', compact('datas'));
    }

    public function create()
    {
        $color = ['secondary', 'dark', 'primary', 'info', 'success', 'warning', 'danger'];

        return view('dashboard.blacklist-maintenance.blacklist-status.create', compact('color'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:blackist_statuses,code',
            'description' => 'required',
            'color' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description', 'color']);
        $input['created_by'] = Auth::user()->id;
        BlackistStatus::create($input);
        return redirect(route('blacklist-status.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $color = ['secondary', 'dark', 'primary', 'info', 'success', 'warning', 'danger'];

        $data = BlackistStatus::find($id);
        return view('dashboard.blacklist-maintenance.blacklist-status.edit', compact('data', 'color'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:blackist_statuses,code,' . $id,
            'description' => 'required',
            'color' => 'required',

        ]);

        $input = Arr::only($request->all(), ['code', 'description', 'color']);
        $input['updated_by'] = Auth::user()->id;
        BlackistStatus::find($id)->update($input);
        return redirect(route('blacklist-status.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        BlackistStatus::find($id)->delete();
        return redirect(route('blacklist-status.index'))->with('success', 'Delete successfully');
    }
}
