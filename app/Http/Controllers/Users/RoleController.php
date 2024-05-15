<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
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
        $list = Role::query();
        if (!empty($search)) {
            $list->where('name', 'LIKE', '%' . $search . '%');
        }
        $list->with('permissions');
        $datas = $list->paginate(10);
        return view('dashboard.user-maintenance.roles.index', compact('datas'));
    }

    public function create()
    {
        $permission = Permission::get()->pluck('name', 'name');
        return view('dashboard.user-maintenance.roles..create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect(route('roles.index'))->with('success', 'Created successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = Role::find($id);
        $permission = Permission::get()->pluck('name', 'name');
        $rolePermissions = Role::find($id)->permissions->pluck('name', 'name');
        return view('dashboard.user-maintenance.roles.edit', compact('data', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required',
        ]);

        $role = Role::find($id)->updated(['name' => $request->input('name')]);
        Role::find($id)->syncPermissions($request->input('permission'));

        return redirect(route('roles.index'))->with('success', 'Created successfully');
    }

    public function destroy(string $id)
    {
        //
    }
}
