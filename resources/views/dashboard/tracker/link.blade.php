@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Incident Report</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<section class="content ">
    <form action="{{ route('tracker.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="col-12 col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        Link Incident Report @if ($link->synopsis) - {{$link->synopsis}} @endif
                    </h4>
                    <input type="hidden" class="form-control" name="link_report" value="{{ $link->id }}">

                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-12 col-md-4 mb-1">
                            <div class="form-group">
                                <label class="form-label">Property<i style="color:red;">*</i></label>
                                <select class="form-control select2" name="property_id" value="{{ old('property_id') }}">
                                    <option value="">Select Property</option>
                                    @foreach ($property as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('property_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('property_id'))
                                <div class="text-danger">{{ $errors->first('property_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-1">
                            <div class="form-group">
                                <label class="form-label">Group Section<i style="color:red;">*</i></label>
                                <select class="form-control select2" name="group_section_id" value="{{ old('group_section_id') }}">
                                    <option value="">Select Group Section</option>
                                    @foreach ($groupsection as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('group_section_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('group_section_id'))
                                <div class="text-danger">{{ $errors->first('group_section_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-1">
                            <div class="form-group">
                                <label class="form-label">Event Date<i style="color:red;">*</i></label>
                                <input type="date" class="form-control" name="event_date" value="{{ old('event_date') }}">

                                @if($errors->has('event_date'))
                                <div class="text-danger">{{ $errors->first('event_date') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12 col-md-3 mb-1">
                            <div class="form-group">
                                <label class="form-label">Area / Location / Sublocation<i style="color:red;">*</i></label>
                                <select class="form-control select2" name="location_id" value="{{ old('location_id') }}">
                                    <option value="">Select Location</option>
                                    @foreach ($location as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('location_id')? 'selected':''}}>{{$a->description}} ({{$a->area->code}})</option>
                                    @endforeach
                                </select>
                                @if($errors->has('location_id'))
                                <div class="text-danger">{{ $errors->first('location_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mb-1">
                            <div class="form-group">
                                <label class="form-label">Report Type<i style="color:red;">*</i></label>
                                <select class="form-control select2" name="report_type_id" value="{{ old('report_type_id') }}">
                                    <option value="">Select Report Type</option>
                                    @foreach ($reporttype as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('report_type_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('report_type_id'))
                                <div class="text-danger">{{ $errors->first('report_type_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-1">
                            <div class="form-group">
                                <label class="form-label">Department \ Incident Title<i style="color:red;">*</i></label>
                                <select class="form-control select2" name="incident_title_id" value="{{ old('incident_title_id') }}">
                                    <option value="">Select Incident Title</option>
                                    @foreach ($incidentTitle as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('incident_title_id')? 'selected':''}}>{{$a->description}} ({{$a->department->code}})</option>
                                    @endforeach
                                </select>
                                @if($errors->has('incident_title_id'))
                                <div class="text-danger">{{ $errors->first('incident_title_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-1">
                            <div class="form-group">
                                <label class="form-label">Origination<i style="color:red;">*</i></label>
                                <select class="form-control select2" name="origin_id" value="{{ old('origin_id') }}">
                                    <option value="">Select Origination</option>
                                    @foreach ($origination as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('origin_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('origin_id'))
                                <div class="text-danger">{{ $errors->first('origin_id') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 mb-1">
                            <div class="form-group">
                                <label class="form-label">Result<i style="color:red;">*</i></label>
                                <select class="form-control select2" name="result_id" value="{{ old('result_id') }}">
                                    <option value="">Select Result</option>
                                    @foreach ($result as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('result_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('result_id'))
                                <div class="text-danger">{{ $errors->first('result_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-1">
                            <div class="form-group">
                                <label class="form-label">Currency</label>
                                <select class="form-control select2" name="currency_id" value="{{ old('currency_id') }}">
                                    <option value="">Select Currency</option>
                                    @foreach ($currency as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('currency_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('currency_id'))
                                <div class="text-danger">{{ $errors->first('currency_id') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">Details<i style="color:red;">*</i></label>
                            <textarea class="form-control" rows="3" name="details"> {{ old('details') }}</textarea>
                            @if($errors->has('details'))
                            <div class=" text-danger">{{ $errors->first('details') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label class="form-label">Action Taken<i style="color:red;">*</i></label>
                                <textarea class="form-control" rows="5" name="action_taken"> {{ old('action_taken') }}</textarea>
                                @if($errors->has('action_taken'))
                                <div class=" text-danger">{{ $errors->first('action_taken') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <!-- <div class="form-group">
                                <label class="form-label">Inspector<i style="color:red;">*</i></label>
                                <select class="form-control select2" name="inspector_id" value="{{ old('inspector_id') }}">
                                    <option value="">Select Inspector</option>
                                    @foreach ($inspector as $a)
                                    <option value="{{$a->id}}" {{$a->id == old('inspector_id')? 'selected':''}}>{{$a->description}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('inspector_id'))
                                <div class=" text-danger">{{ $errors->first('inspector_id') }}
                                </div>
                                @endif
                            </div> -->
                            <div class="form-group">
                                <label class="form-label">Verified By</label>
                                <input type="text" class="form-control " name="verified_by" value="{{ old('verified_by') }}">
                                @if($errors->has('verified_by'))
                                <div class=" text-danger">{{ $errors->first('verified_by') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">Blacklist</label>
                            <select class="form-control select2" multiple="multiple" size="5" data-placeholder="Select on Blacklist" name="blacklist[]">
                                @foreach ($blacklist as $a)
                                <option value="{{$a->id}}" {{$a->id == old('blacklist')? 'selected':''}}>{{$a->last_name}}, {{$a->first_name}} {{$a->middle_name}} </option>
                                @endforeach
                            </select> @if($errors->has('details'))
                            <div class=" text-danger">{{ $errors->first('details') }}
                            </div>
                            @endif
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label class="form-label">Type</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-1">
                            <div class="form-group">
                                <label class="form-label">Member ID</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label class="form-label">Nationality</label>

                            </div>
                        </div>
                        <div class="col-12 col-md-1">
                            <div class="form-group">
                                <label class="form-label">Barred</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-1">
                            <div class="form-group">
                                <label class="form-label">Initiatior</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-1">
                            <div class="form-group">
                                <label class="form-label">Action</label>
                            </div>
                        </div>
                    </div>


                    <div id="formContainer">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <select class="form-control" data-placeholder="Select on Blacklist" name="blacklist[type][]">
                                        <option value="Member">Member</option>
                                        <option value="Non - Member">Non - Member</option>
                                        <option value="Employee">Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="blacklist[member_id][]">
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="blacklist[first_name][]">
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="blacklist[last_name][]">
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <select class="form-control select2" data-placeholder="Select on Nationality" name="blacklist[nationality][]">
                                        @foreach ($nationality as $a)
                                        <option value="{{$a}}">{{$a}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-1">
                                <div class="form-group">
                                    <select class="form-control" data-placeholder="Select on Nationality" name="blacklist[barred][]">
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-1">
                                <div class="form-group">
                                    <select class="form-control" data-placeholder="Select on Nationality" name="blacklist[initiator][]">
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-warning btn-sm" onclick="removeField(this)">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-success" onclick="addField()">Add Field</button>


                </div>
                <div class="box-footer text-end">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti-save-alt"></i> Save
                    </button>
                    <a href="{{ route('tracker.index') }}" class="btn btn-warning btn-sm me-1">
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
<script>
    function addField() {
        var formContainer = document.getElementById("formContainer");
        var lastFieldContainer = formContainer.lastElementChild;
        var clonedFieldContainer = lastFieldContainer.cloneNode(true);

        var removeBtn = clonedFieldContainer.querySelector(".btn");
        removeBtn.addEventListener("click", function() {
            removeField(this);
        });

        formContainer.appendChild(clonedFieldContainer);
    }

    function removeField(button) {
        var formContainer = document.getElementById("formContainer");
        var fieldContainer = button.closest('.row');
        if (formContainer.childElementCount > 1) {
            formContainer.removeChild(fieldContainer);
        } else {
            alert("You cannot remove all fields!");
        }
    }
</script>
@endsection