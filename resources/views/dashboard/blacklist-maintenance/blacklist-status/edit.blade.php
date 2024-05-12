@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Blacklist Maintenance</li>
                        <li class="breadcrumb-item" aria-current="page">Status</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<section class="content">
    <form action="{{ route('blacklist-status.update',$data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-12 col-lg-4">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Status</h4>
                </div>

                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Code<i style="color:red;">*</i></label>
                            <input type="text" class="form-control" name="code" value="{{$data->code}}">
                            @if($errors->has('code'))
                            <div class="text-danger">{{ $errors->first('code') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Description<i style="color:red;">*</i></label>
                            <input type="text" class="form-control" name="description" value="{{$data->description}}">
                            @if($errors->has('description'))
                            <div class=" text-danger">{{ $errors->first('description') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Color<i style="color:red;">*</i></label>
                            <select class="form-control select2" style="width: 100%;" name="color" value="{{ old('color') }}">
                                <option value="">Select Color</option>
                                @foreach ($color as $a)
                                <option value="{{$a}}" {{$a == $data->color? 'selected' :''}} class="text-{{$a}}">{{$a}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('origination_id'))
                            <div class="text-danger">{{ $errors->first('origination_id') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer text-end">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti-save-alt"></i> Save
                    </button>
                    <a href="{{ route('blacklist-status.index') }}" class="btn btn-warning btn-sm me-1">
                        <i class="ti-trash"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

</section>
@endsection