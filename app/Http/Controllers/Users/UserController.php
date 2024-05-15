<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Users\UserLevel;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users\UserDesignation;
use App\Models\Maintenance\Department;

class UserController extends Controller
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
        $department_id = Arr::get($requestParams, 'department_id', '');
        $user_level_id = Arr::get($requestParams, 'user_level_id', '');
        $user_designation_id = Arr::get($requestParams, 'user_designation_id', '');
        $list = User::query();
        if (!empty($search)) {
            $list->where('emp_id', 'LIKE', '%' . $search . '%');
            $list->orWhere('first_name', 'LIKE', '%' . $search . '%');
            $list->orWhere('middle_name', 'LIKE', '%' . $search . '%');
            $list->orWhere('last_name', 'LIKE', '%' . $search . '%');
            $list->orWhere('email', 'LIKE', '%' . $search . '%');
        }
        if (!empty($department_id)) {
            $list->where('department_id', '=', $department_id);
        }
        if (!empty($user_level_id)) {
            $list->where('user_level_id', '=', $user_level_id);
        }
        if (!empty($user_designation_id)) {
            $list->where('user_designation_id', '=', $user_designation_id);
        }
        $list->sortable(['created_at' => 'desc']);
        $list->with('createdBy', 'updatedBy', 'department', 'userLevel', 'userDesignation');

        $datas = $list->paginate(10);
        return view('dashboard.user-maintenance.user.index', compact('datas'));
    }

    public function create()
    {
        $department = Department::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $role = Role::get()->pluck('name');
        $userLevel = UserLevel::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $userDesignation = UserDesignation::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        return view('dashboard.user-maintenance.user.create', compact('department', 'role', 'userLevel', 'userDesignation'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'emp_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'department_id' => 'required',
            'user_level_id' => 'required',
            'user_designation_id' => 'required',
            'roles' => 'required',
        ]);

        $input = Arr::only($request->all(), ['emp_id', 'first_name', 'middle_name', 'last_name', 'email', 'department_id', 'user_level_id', 'user_designation_id']);
        $input['created_by'] = Auth::user()->id;
        $input['password'] = Hash::make('password');

        $res = User::create($input);
        $res->syncRoles($request->roles);

        return redirect(route('users.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $department = Department::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $role = Role::get()->pluck('name');
        $userLevel = UserLevel::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $userDesignation = UserDesignation::select('id', 'code', 'description')->sortable(['description' => 'desc'])->get();
        $data = User::find($id);
        return view('dashboard.user-maintenance.user.edit', compact('data', 'department', 'role', 'userLevel', 'userDesignation'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'emp_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'department_id' => 'required',
            'user_level_id' => 'required',
            'user_designation_id' => 'required',
            'roles' => 'required',
        ]);

        $input = Arr::only($request->all(), ['emp_id', 'first_name', 'middle_name', 'last_name', 'email', 'department_id', 'user_level_id', 'user_designation_id']);
        $input['updated_by'] = Auth::user()->id;

        User::find($id)->update($input);
        $res = User::find($id);
        $res->syncRoles($request->roles);

        return redirect(route('users.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect(route('users.index'))->with('success', 'Delete successfully');
    }
}
