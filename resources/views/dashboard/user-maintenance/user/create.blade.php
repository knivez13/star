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
                        <li class="breadcrumb-item" aria-current="page">Users</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<section class="content ">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="col-12 col-lg-8">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Users</h4>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Emp ID<i style="color:red;">*</i></label>
                                <input type="text" class="form-control" name="emp_id" value="{{ old('emp_id') }}">
                                @if($errors->has('emp_id'))
                                <div class="text-danger">{{ $errors->first('emp_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label class="form-label">Email<i style="color:red;">*</i></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">First Name<i style="color:red;">*</i></label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                                @if($errors->has('first_name'))
                                <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
                                @if($errors->has('middle_name'))
                                <div class="text-danger">{{ $errors->first('middle_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Last Name<i style="color:red;">*</i></label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                @if($errors->has('last_name'))
                                <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Department<i style="color:red;">*</i></label>
                                <select class="form-control select2" style="width: 100%;" name="department_id">
                                    @foreach ($department as $a)
                                    <option value="{{$a->id}}" {{$a == old('department_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('department_id'))
                                <div class="text-danger">{{ $errors->first('department_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Level<i style="color:red;">*</i></label>
                                <select class="form-control select2" style="width: 100%;" name="user_level_id">
                                    @foreach ($userLevel as $a)
                                    <option value="{{$a->id}}" {{$a == old('user_level_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('user_level_id'))
                                <div class="text-danger">{{ $errors->first('user_level_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Designation<i style="color:red;">*</i></label>
                                <select class="form-control select2" style="width: 100%;" name="user_designation_id">
                                    @foreach ($userDesignation as $a)
                                    <option value="{{$a->id}}" {{$a == old('user_designation_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('user_designation_id'))
                                <div class="text-danger">{{ $errors->first('user_designation_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Role<i style="color:red;">*</i></label>
                                <select class="form-control select2" style="width: 100%;" name="roles">
                                    @foreach ($role as $a)
                                    <option value="{{$a}}" {{$a == old('role')? 'selected':''}}>{{$a}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('role'))
                                <div class="text-danger">{{ $errors->first('role') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer text-end">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti-save-alt"></i> Save
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm me-1">
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