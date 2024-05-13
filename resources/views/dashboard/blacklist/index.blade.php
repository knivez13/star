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
                        <li class="breadcrumb-item active" aria-current="page">Barred Patrons</li>
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
                <h4 class="box-title">Barred Patrons</h4>
                <div class="box-controls pull-right">
                    <div class="form-group mb-0">
                        <span class="input-group-btn">
                            <a href="{{ route('blacklist.create') }}" class="btn btn-primary bootstrap-touchspin-up btn-sm"> Add New</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <form action="{{ route('blacklist.index') }}" method="POST">
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
                                <div class="form-group">
                                    <select class="form-control select2" style="width: 100%;" name="blackist_status_id" value="{{ old('blackist_status_id') }}">
                                        <option value="">Select Status</option>
                                        @foreach ($blackiststatus ?? [] as $a)
                                        <option value="{{$a->id}}" {{$a->id ==  app('request')->input('blackist_status_id') ? 'selected' :''}}>{{$a->description}}</option>
                                        @endforeach

                                    </select>
                                    @if($errors->has('blackist_status_id'))
                                    <div class="text-danger">{{ $errors->first('blackist_status_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mb-3">
                                <div class="form-group">
                                    <select class="form-control select2" style="width: 100%;" name="blackist_type_id" value="{{ old('blackist_type_id') }}">
                                        <option value="">Select Type</option>
                                        @foreach ($blackisttype ?? [] as $a)
                                        <option value="{{$a->id}}" {{$a->id ==  app('request')->input('blackist_type_id') ? 'selected' :''}}>{{$a->description}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('blackist_type_id'))
                                    <div class="text-danger">{{ $errors->first('blackist_type_id') }}</div>
                                    @endif
                                </div>
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
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('member_id','Member ID')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('first_name','First Name')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('middle_name','Middle Name')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('last_name','Last Name')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('date_hired','Date Hired')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('blackistStatus.description','Status')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('blackistType.description ','Type')</th>
                            <th style="margin: 0; white-space: nowrap;">Synopsis</th>
                            <th style="margin: 0; white-space: nowrap;">Image</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('created_at','Date Created')</th>
                            @can('Show Create and Update User')
                            <th style="margin: 0; white-space: nowrap;">Created by</th>
                            <th style="margin: 0; white-space: nowrap;">Updated at</th>
                            <th style="margin: 0; white-space: nowrap;">Updated by</th>
                            @endcan
                        </tr>
                        @forelse($datas as $a)
                        <tr class="bg-{{ $a->blackistStatus->color }}">
                            <td style="margin: 0; white-space: nowrap;">{{ $a->member_id }}</td>
                            <td style="margin: 0; white-space: nowrap;"><a href="{{ route('blacklist.edit', $a->id) }}">{{ $a->first_name }}</a></td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->middle_name }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->last_name }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->date_hired }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->blackistStatus->description }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->blackistType->description }}</td>
                            <td>
                                @foreach ( $a->incidentReport as $a)
                                <a href="{{ route('tracker.show', $a->incidentReport->id) }}">{{ $a->incidentReport->synopsis }}</a>
                                @endforeach

                            </td>
                            <td class="no-padding" style="margin: 0; white-space: nowrap;">
                                <a class="avatar avatar-sm">
                                    <img src="{{$a->image_path}}">
                                </a>
                                @if ($a->image_path2)
                                <a class="avatar avatar-sm">
                                    <img src="{{$a->image_path2}}">
                                </a>
                                @endif
                                @if ($a->image_path3)
                                <a class="avatar avatar-sm">
                                    <img src="{{$a->image_path3}}">
                                </a>
                                @endif

                            </td>
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