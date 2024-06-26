<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\UserLevel;

class UserLevelController extends Controller
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
        $list = UserLevel::query();
        if (!empty($search)) {
            $list->where('code', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
        }
        $list->sortable('code');
        $list->with('createdBy', 'updatedBy');

        $datas = $list->paginate(10);
        return view('dashboard.user-maintenance.user-level.index', compact('datas'));
    }

    public function create()
    {
        return view('dashboard.user-maintenance.user-level.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:user_levels,code',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['created_by'] = Auth::user()->id;
        UserLevel::create($input);
        return redirect(route('user-level.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = UserLevel::find($id);
        return view('dashboard.user-maintenance.user-level.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:user_levels,code,' . $id,
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['updated_by'] = Auth::user()->id;
        UserLevel::find($id)->update($input);
        return redirect(route('user-level.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        UserLevel::find($id)->delete();
        return redirect(route('user-level.index'))->with('success', 'Delete successfully');
    }
}
