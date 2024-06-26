<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Maintenance\Currency;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
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
        $list = Currency::query();
        if (!empty($search)) {
            $list->where('code', 'LIKE', '%' . $search . '%');
            $list->orWhere('description', 'LIKE', '%' . $search . '%');
        }
        $list->sortable('code');
        $list->with('createdBy', 'updatedBy');

        $datas = $list->paginate(10);
        return view('dashboard.maintenance.currency.index', compact('datas'));
    }

    public function create()
    {
        return view('dashboard.maintenance.currency.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:currencies,code',
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['created_by'] = Auth::user()->id;
        Currency::create($input);
        return redirect(route('currency.index'))->with('success', 'Created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Currency::find($id);
        return view('dashboard.maintenance.currency.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:currencies,code,' . $id,
            'description' => 'required',
        ]);

        $input = Arr::only($request->all(), ['code', 'description']);
        $input['updated_by'] = Auth::user()->id;
        Currency::find($id)->update($input);
        return redirect(route('currency.index'))->with('success', 'Update successfully');
    }

    public function destroy($id)
    {
        Currency::find($id)->delete();
        return redirect(route('currency.index'))->with('success', 'Delete successfully');
    }
}
