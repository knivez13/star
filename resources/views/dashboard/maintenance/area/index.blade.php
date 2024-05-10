@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <!-- <h3 class="page-title">Blank page</h3> -->
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Maintenance</li>
                        <li class="breadcrumb-item active" aria-current="page">Position</li>
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
                <h4 class="box-title">Position</h4>
                <div class="box-controls pull-right">
                    <div class="lookup-right px-2">
                        <a href="{{ route('area.create') }}" class="btn-primary btn-sm">Add New</a>
                    </div>
                    <div class="lookup lookup-circle lookup-right">
                        <input type="search" name="search" value="{{ app('request')->input('search') }}">
                    </div>

                </div>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>@sortablelink('name')</th>
                            <th>@sortablelink('created_at','Date Created')</th>
                            @can('view-created-updated')
                            <th>Created by</th>
                            <th>Updated at</th>
                            <th>Updated by</th>
                            @endcan
                        </tr>
                        @forelse($datas as $a)
                        <tr>
                            <td><a href="{{ route('area.edit', $a->id) }}">{{ $a->name }}</a></td>
                            <td>{{ $a->created_at }}</td>
                            @can('view-created-updated')
                            <td>{{ $a->createdBy->name ?? '' }}</td>
                            <td>{{ $a->updated_at }}</td>
                            <td>{{ $a->updatedBy->name ?? '' }}</td>
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