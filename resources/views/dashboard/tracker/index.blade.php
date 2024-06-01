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
                        <li class="breadcrumb-item active" aria-current="page">Incident Report</li>
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
                <h4 class="box-title">Incident Report</h4>
                <div class="box-controls pull-right">
                    <div class="form-group mb-0">
                        <span class="input-group-btn">
                            <a href="{{ route('tracker.create') }}" class="btn btn-primary bootstrap-touchspin-up btn-sm"> Add New</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <form action="{{ route('tracker.index') }}" method="POST">
                    @csrf
                    @method('GET')
                    <div class="p-10">
                        <div class="row">
                            <div class="col-12 col-md-3 mb-3">
                                <input placeholder="Search.." type="search" value="{{ app('request')->input('search') }}" class="form-control " name="search" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-secondary" style="display: block;">
                            </div>
                            <div class="col-12 col-md-2 mb-3">
                                <input placeholder="Search by date" type="date" value="{{ app('request')->input('date_search') }}" class="form-control " name="date_search" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-secondary" style="display: block;">
                            </div>
                            <div class="col-12 col-md-2 mb-3 ">
                                <select class="form-control select2 " style="width: 100%;" name="property_id" value="{{ old('property_id') }}">
                                    <option value="">Select Property</option>
                                    @foreach ($property ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('property_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-3">
                                <select class="form-control select2" style="width: 100%;" name="group_section_id" value="{{ old('group_section_id') }}">
                                    <option value="">Select Group Section</option>
                                    @foreach ($groupsection ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('group_section_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-3">
                                <select class="form-control select2" style="width: 100%;" name="department_id" value="{{ old('department_id') }}">
                                    <option value="">Select Department</option>
                                    @foreach ($department ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('department_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-1 mb-1">
                                <button class="btn btn-primary btn-sm form-control">Search</button>
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <select class="form-control select2" style="width: 100%;" name="area_id" value="{{ old('area_id') }}">
                                    <option value="">Select Area</option>
                                    @foreach ($area ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('area_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <select class="form-control select2" style="width: 100%;" name="location_id" value="{{ old('location_id') }}">
                                    <option value="">Select Location</option>
                                    @foreach ($location ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('location_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <select class="form-control select2" style="width: 100%;" name="origin_id" value="{{ old('origin_id') }}">
                                    <option value="">Select Origination</option>
                                    @foreach ($origination ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('origin_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <select class="form-control select2" style="width: 100%;" name="report_status_id" value="{{ old('report_status_id') }}">
                                    <option value="">Select Status</option>
                                    @foreach ($reportstatus ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == app('request')->input('report_status_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('synopsis','synopsis')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('link_report','Report Link')</th>
                            <th style="margin: 0; white-space: nowrap;">Incident Title</th>
                            <th style="margin: 0; white-space: nowrap;">Property</th>
                            <th style="margin: 0; white-space: nowrap;">Group Section</th>
                            <th style="margin: 0; white-space: nowrap;">Status</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('event_date','Event Date')</th>
                            <th style="margin: 0; white-space: nowrap;">Area</th>
                            <th style="margin: 0; white-space: nowrap;">Location</th>
                            <th style="margin: 0; white-space: nowrap;">Department</th>
                            <th style="margin: 0; white-space: nowrap;">Origination</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('created_at','Date Created')</th>
                            @can('Show Create and Update User')
                            <th style="margin: 0; white-space: nowrap;">Created by</th>
                            <th style="margin: 0; white-space: nowrap;">Updated at</th>
                            <th style="margin: 0; white-space: nowrap;">Updated by</th>
                            @endcan
                        </tr>
                        @forelse($datas as $a)
                        <tr>
                            <td style="margin: 0; white-space: nowrap;"><a href="{{ route('tracker.show', $a->id) }}">{{ $a->synopsis }}</a></td>
                            <td style="margin: 0; white-space: nowrap;">
                                @if ($a->link_report)
                                <a href="{{ route('tracker.show', $a->linkReport['id']) }}">{{ $a->link_report ? $a->linkReport['synopsis'] : null }}</a>
                                @endif
                            </td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->incidentTitle->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->property->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->groupSection->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->reportStatus->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->event_date }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->area->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->location->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->department->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->origination->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->created_at }}</td>
                            @can('Show Create and Update User')
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