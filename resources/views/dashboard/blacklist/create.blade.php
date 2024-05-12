@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Barred Patrons</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<section class="content ">
    <form action="{{ route('blacklist.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="col-12 ">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Barred Patrons</h4>
                </div>

                <div class="box-body">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Member ID</label>
                            <input type="text" class="form-control" name="member_id">
                            @if($errors->has('member_id'))
                            <div class=" text-danger">{{ $errors->first('member_id') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">First Name<i style="color:red;">*</i></label>
                                <input type="text" class="form-control" name="first_name">
                                @if($errors->has('first_name'))
                                <div class=" text-danger">{{ $errors->first('first_name') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name">
                                @if($errors->has('middle_name'))
                                <div class=" text-danger">{{ $errors->first('middle_name') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Last Name<i style="color:red;">*</i></label>
                                <input type="text" class="form-control" name="last_name">
                                @if($errors->has('last_name'))
                                <div class=" text-danger">{{ $errors->first('last_name') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date Hired</label>
                                <input type="date" class="form-control" name="date_hired">
                                @if($errors->has('date_hired'))
                                <div class=" text-danger">{{ $errors->first('date_hired') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Status<i style="color:red;">*</i></label>
                                <select class="form-control select2" style="width: 100%;" name="blackist_status_id" value="{{ old('blackist_status_id') }}">
                                    <option value="">Select Status</option>
                                    @foreach ($blackiststatus ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('blackist_status_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach

                                </select>
                                @if($errors->has('blackist_status_id'))
                                <div class="text-danger">{{ $errors->first('blackist_status_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Type<i style="color:red;">*</i></label>
                                <select class="form-control select2" style="width: 100%;" name="blackist_type_id" value="{{ old('blackist_type_id') }}">
                                    <option value="">Select Type</option>
                                    @foreach ($blackisttype ?? [] as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('blackist_type_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('origination_id'))
                                <div class="text-danger">{{ $errors->first('origination_id') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Image 1<i style="color:red;">*</i></label>
                                <input type="file" class="form-control" rows="7" name="image_path">
                                @if($errors->has('image_path'))
                                <div class=" text-danger">{{ $errors->first('image_path') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Image 2</label>
                                <input type="file" class="form-control" rows="7" name="image_path2">
                                @if($errors->has('image_path2'))
                                <div class=" text-danger">{{ $errors->first('image_path2') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Image 3</label>
                                <input type="file" class="form-control" rows="7" name="image_path3">
                                @if($errors->has('image_path3'))
                                <div class=" text-danger">{{ $errors->first('image_path3') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer text-end">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti-save-alt"></i> Save
                    </button>
                    <a href="{{ route('blacklist.index') }}" class="btn btn-warning btn-sm me-1">
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