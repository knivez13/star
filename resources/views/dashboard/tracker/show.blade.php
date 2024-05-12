@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Incident Reports</li>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Incident Report - {{$data->synopsis}}</h4>
                </div>
                <div class="box-body ">
                    @if ($data->link_report)
                    <p class="mb-1 fs-20 mb-3"><strong>Link Report</strong> : {{$data->linkReport->synopsis ?? null}}</p>
                    @endif
                    <p class="mb-1 fs-20"><strong>Incident Title</strong> : {{$data->incidentTitle->description ?? null}}</p>

                    <p class="mb-1"><strong>Property</strong> : {{$data->property->description ?? null}}</p>
                    <p class="mb-1"><strong>Group Section</strong> : {{$data->groupSection->description ?? null}}</p>
                    <p class="mb-1"><strong>Event Date</strong> : {{$data->event_date ?? null}}</p>
                    <p class="mb-1"><strong>Area</strong> : {{$data->area->description ?? null}}</p>
                    <p class="mb-1"><strong>Location</strong> : {{$data->location->description ?? null}}</p>
                    <p class="mb-1"><strong>Description</strong> : {{$data->description ?? null}}</p>
                    <p class="mb-1"><strong>Department</strong> : {{$data->department->description ?? null}}</p>
                    <p class="mb-1"><strong>Report Type</strong> : {{$data->reportType->description ?? null}}</p>
                    <p class="mb-1"><strong>Origination</strong> : {{$data->Origination->description ?? null}}</p>
                    <p class="mb-1"><strong>Result</strong> : {{$data->result->description ?? null}}</p>
                    <p class="mb-1"><strong>Currency</strong> : {{$data->currency->description ?? null}}</p>
                    <p class="mb-1"><strong>Total Value</strong> : {{$data->total_value ?? null}}</p>
                    <p class="mb-1"><strong>Details</strong> : {{$data->details ?? null}}</p>
                    <p class="mb-1"><strong>Action Taken</strong> : {{$data->action_taken ?? null}}</p>
                    <p class="mb-1"><strong>Inspector</strong> : {{$data->inspector->description ?? null}}</p>
                    <p class="mb-1"><strong>Verified By</strong> : {{$data->verified_by ?? null}}</p>
                    <!-- {{ json_encode($data)}} -->
                </div>

            </div>

        </div>
        <div class="col-12 col-md-4">
            <div class="box">
                <div class="box-body">
                    <div class="col-12 mb-3">
                        <a href="{{ route('tracker.edit', $data->id) }}" class="btn btn-primary form-control">Edit</a>
                    </div>
                    <div class="col-12 mb-3">
                        <a href="{{ route('traker.link', $data->id) }}" class="btn btn-info form-control">Create Link Report</a>
                    </div>
                    <div class="col-12 mb-3">
                        <a href="{{ route('traker.link', $data->id) }}" class="btn btn-secondary form-control">Reply For Close</a>
                    </div>
                    <div class="col-12 mb-3">
                        <a href="{{ route('traker.link', $data->id) }}" class="btn btn-success form-control">Total Close</a>
                    </div>
                    <div class="col-12 mb-3">
                        <a href="{{ route('traker.link', $data->id) }}" class="btn btn-danger form-control">Void</a>
                    </div>
                </div>
            </div>


</section>
@endsection