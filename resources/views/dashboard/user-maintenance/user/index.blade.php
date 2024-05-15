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
                        <li class="breadcrumb-item" aria-current="page">User Maintenance</li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                <h4 class="box-title">Users</h4>
                <div class="box-controls pull-right">
                    <div class="form-group mb-0">
                        <form action="{{ route('users.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <div class="input-group bootstrap-touchspin ">
                                <input placeholder="Search.." style="width:250px" type="search" value="{{ app('request')->input('search') }}" class="form-control form-control-sm " name="search" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-secondary" style="display: block;">
                                <span class="input-group-btn">
                                    <a href="{{ route('users.create') }}" class="btn btn-primary bootstrap-touchspin-up btn-sm"> Add New</a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('emp_id','Emp Id')</th>
                            <th style="margin: 0; white-space: nowrap;">Role</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('first_name','First Name')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('middle_name','Middle Name')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('last_name','Last Name')</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('email','Email')</th>
                            <th style="margin: 0; white-space: nowrap;">Department</th>
                            <th style="margin: 0; white-space: nowrap;">Level</th>
                            <th style="margin: 0; white-space: nowrap;">Designation</th>
                            <th style="margin: 0; white-space: nowrap;">@sortablelink('created_at','Date Created')</th>
                            @can('Show Create and Update User')
                            <th style="margin: 0; white-space: nowrap;">Created by</th>
                            <th style="margin: 0; white-space: nowrap;">Updated at</th>
                            <th style="margin: 0; white-space: nowrap;">Updated by</th>
                            @endcan

                        </tr>
                        @forelse($datas as $a)
                        <tr>
                            <td style="margin: 0; white-space: nowrap;">
                                @if ($a->roles[0]->name != 'SystemAdmin')
                                <a href="{{ route('users.edit', $a->id) }}">{{ $a->emp_id }}</a>
                                @else
                                {{ $a->emp_id }}
                                @endif
                            </td>

                            <td style="margin: 0; white-space: nowrap;">{{ $a->roles[0]->name }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->first_name }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->middle_name }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->last_name }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->email }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->department->description ?? null }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->userLevel->description ?? null }}</td>
                            <td style="margin: 0; white-space: nowrap;">{{ $a->userDesignation->description  ?? null}}</td>
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