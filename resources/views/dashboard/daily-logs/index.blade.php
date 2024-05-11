@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <!-- <h3 class="page-title">Blank page</h3> -->
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daily Logs</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<section class="content">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Daily Logs</h4>
                <div class="box-controls pull-right">
                    <div class="form-group mb-0">
                        <span class="input-group-btn">
                            <a href="{{ route('daily-logs.create') }}" class="btn btn-primary bootstrap-touchspin-up btn-sm"> Add New</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <form action="{{ route('daily-logs.index') }}" method="POST">
                    @csrf
                    @method('GET')
                    <div class="p-10">
                        <div class="row">
                            <div class="col-12 col-md-5 mb-3">
                                <input placeholder="Search.." type="search" value="{{ app('request')->input('search') }}" class="form-control " name="search" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-secondary" style="display: block;">
                            </div>
                            <div class="col-12 col-md-2 mb-3">
                                <input placeholder="Search by date" type="date" value="{{ app('request')->input('date_search') }}" class="form-control " name="date_search" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-secondary" style="display: block;">
                            </div>
                            <div class="col-12 col-md-2 mb-3">
                                <select class="form-control select2" style="width: 100%;" name="group_section_id" value="{{ old('group_section_id') }}">
                                    <option value="">Select Group Section</option>
                                    @foreach ($group_section as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('group_section_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-3">
                                <select class="form-control select2" style="width: 100%;" name="origination_id" value="{{ old('origination_id') }}">
                                    <option value="">Select Origination</option>
                                    @foreach ($origin as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('origination_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-1 mb-1">
                                <button class="btn btn-primary btn-sm form-control">Search</button>
                            </div>
                        </div>

                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>@sortablelink('inv_no','Logs No')</th>
                            <th>Origination</th>
                            <th>Group Section</th>
                            <th>@sortablelink('description')</th>
                            <th>@sortablelink('created_at','Date Created')</th>
                            @can('view-created-updated')
                            <th>Created by</th>
                            <th>Updated at</th>
                            <th>Updated by</th>
                            @endcan
                        </tr>
                        @forelse($datas as $a)
                        <tr>
                            <td style="margin: 0; white-space: nowrap;"><a href="{{ route('daily-logs.edit', $a->id) }}">{{ $a->inv_no }}</a></td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->origination->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->groupSection->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->created_at }}</td>
                            @can('view-created-updated')
                            <td style="margin: 0; white-space: nowrap;">{{ $a->createdBy->first_name ?? '' }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->updated_at }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->updatedBy->first_name ?? '' }}</td>
                            @endcan
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100" class="text-center">No Data Available</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="box-footer text-end">
                {!! $datas->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="{{ asset('./assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('./js/pages/advanced-form-element.js') }}"></script>
@endsection