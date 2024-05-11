@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Daily Logs</li>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<section class="content">
    <form action="{{ route('daily-logs.update',$data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-12 col-lg-4">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Daily Logs</h4>
                </div>

                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Group Section<i style="color:red;">*</i></label>
                            <select class="form-control select2" style="width: 100%;" name="group_section_id">
                                <option value="">Select Group Section</option>
                                @foreach ($group_section as $a)
                                <option value="{{$a->id}}" {{$a->id == $data->group_section_id ? 'selected':''}}>{{$a->description}}</option>
                                @endforeach

                            </select>
                            @if($errors->has('group_section_id'))
                            <div class="text-danger">{{ $errors->first('group_section_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Origination<i style="color:red;">*</i></label>
                            <select class="form-control select2" style="width: 100%;" name="origination_id">
                                <option value="">Select Origination</option>
                                @foreach ($origin as $a)
                                <option value="{{$a->id}}" {{$a->id == $data->origination_id ? 'selected':''}}>{{$a->description}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('origination_id'))
                            <div class="text-danger">{{ $errors->first('origination_id') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Description<i style="color:red;">*</i></label>
                            <textarea class="form-control" rows="7" name="description"> {{$data->description}}</textarea>
                            @if($errors->has('description'))
                            <div class=" text-danger">{{ $errors->first('description') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer text-end">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti-save-alt"></i> Save
                    </button>
                    <a href="{{ route('daily-logs.index') }}" class="btn btn-warning btn-sm me-1">
                        <i class="ti-trash"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

</section>
@endsection
@section('script')
<script src="{{ asset('./assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('./js/pages/advanced-form-element.js') }}"></script>
@endsection