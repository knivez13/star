@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">User Maintenance</li>
                        <li class="breadcrumb-item" aria-current="page">Roles</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<section class="content ">
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="col-12 col-lg-4">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Roles</h4>
                </div>

                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Name<i style="color:red;">*</i></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @if($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Permission<i style="color:red;">*</i></label>
                            <select class="form-control select2" multiple="mutilple" style="width: 100%;" name="permission[]">
                                @foreach ($permission as $a)
                                <option value="{{$a}}" {{$a == old('permission[]')? 'selected':''}}>{{$a}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('permission[]'))
                            <div class="text-danger">{{ $errors->first('permission[]') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer text-end">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti-save-alt"></i> Save
                    </button>
                    <a href="{{ route('roles.index') }}" class="btn btn-warning btn-sm me-1">
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