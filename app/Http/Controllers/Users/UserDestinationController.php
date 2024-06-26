<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\UserDesignation;

class UserDestinationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:View User Setting', ['only' => ['index']]);
        $this->middleware('permission:Create User Setting', ['only' => ['create', 'store']]);
        $this->middleware('permission:Update User Setting', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete User Setting', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $requestParams = $request->all();
        $search = Arr::get($requestParams, 'search', '');
        $list = UserDesignation::query();
        if (!empty($search)) {
            $list->where('code', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
        }
        $list->sortable('code');
        $list->with('createdBy', 'updatedBy');

        $datas = $list->paginate(10);
        return view('dashboard.user-maintenance.user-desination.index', compact('datas'));
    }

    public function create()
    {
        return view('dashboard.user-maintenance.user-desination.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:user_designations,code',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['created_by'] = Auth::user()->id;
        UserDesignation::create($input);
        return redirect(route('user-designation.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = UserDesignation::find($id);
        return view('dashboard.user-maintenance.user-desination.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:user_designations,code,' . $id,
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['updated_by'] = Auth::user()->id;
        UserDesignation::find($id)->update($input);
        return redirect(route('user-designation.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        UserDesignation::find($id)->delete();
        return redirect(route('user-designation.index'))->with('success', 'Delete successfully');
    }
}
