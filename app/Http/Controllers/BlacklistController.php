<?php

namespace App\Http\Controllers;

use App\Models\Blacklist;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blacklist\BlackistType;
use App\Models\Blacklist\BlackistStatus;

class BlacklistController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:View Barred Patrons', ['only' => ['index']]);
        $this->middleware('permission:Create Barred Patrons', ['only' => ['create', 'store']]);
        $this->middleware('permission:Update Barred Patrons', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Barred Patrons', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $requestParams = $request->all();
        $search = Arr::get($requestParams, 'search', '');
        $blackist_status_id = Arr::get($requestParams, 'blackist_status_id', '');
        $blackist_type_id = Arr::get($requestParams, 'blackist_type_id', '');
        $list = Blacklist::query();
        if (!empty($search)) {
            $list->where('member_id', 'LIKE', '%' . $search . '%');
            $list->orWhere('first_name', 'LIKE', '%' . $search . '%');
            $list->orWhere('middle_name', 'LIKE', '%' . $search . '%');
            $list->orWhere('last_name', 'LIKE', '%' . $search . '%');
        }
        if (!empty($blackist_status_id)) {
            $list->where('blackist_status_id', '=',  $blackist_status_id);
        }
        if (!empty($blackist_type_id)) {
            $list->where('blackist_type_id', '=',  $blackist_type_id);
        }
        $list->sortable(['created_at' => 'desc']);
        $list->with('createdBy', 'updatedBy', 'blackistStatus', 'blackistType');

        $datas = $list->paginate(10);
        $blackiststatus = BlackistStatus::get();
        $blackisttype = BlackistType::get();
        return view('dashboard.blacklist.index', compact('datas', 'blackiststatus', 'blackisttype'));
    }

    public function create()
    {

        $blackiststatus = BlackistStatus::get();
        $blackisttype = BlackistType::get();
        return view('dashboard.blacklist.create', compact('blackiststatus', 'blackisttype'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'blackist_status_id' => 'required',
            'blackist_type_id' => 'required',
            'image_path' => 'required',
        ]);

        $input = Arr::only($request->all(), ['member_id', 'date_hired', 'first_name', 'middle_name', 'last_name', 'blackist_status_id', 'blackist_type_id']);

        $fileName = time() . '' . Str::random(10) . '.' . $request->image_path->extension();
        $request->image_path->storeAs('public/blacklist/image/', $fileName);
        $cover_photo = request()->getSchemeAndHttpHost() . '/' . 'storage/'  . 'blacklist/image/' . $fileName;


        $input['created_by'] = Auth::user()->id;
        $input['image_path'] = $cover_photo;
        Blacklist::create($input);
        return redirect(route('blacklist.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Blacklist::find($id);
        return view('dashboard.blacklist.edit', compact('data'));
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
        return redirect(route('blacklist.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        Blacklist::find($id)->delete();
        return redirect(route('blacklist.index'))->with('success', 'Delete successfully');
    }
}
