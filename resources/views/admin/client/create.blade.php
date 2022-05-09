@extends('layouts.admin')

@section('content')
<div class="card card-indigo mt-1">
    <div class="card-header">
        <h3 class="card-title">Create Client</h3>

        <a href="{{url('inClient')}}" class="float-right"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{url('inClient')}}" method="POST" enctype="multipart/form-data" id="webForm">
        @csrf
        <div class="row card-body">
            <div class="col-md-3 form-group">
                <label for="subAdminId">Select Sub Admin <sup class="text-danger">(*)</sup></label>
                <select name="subAdminId" id="subAdminId" class="form-control">
                    <option value="">---Select---</option>
                    @foreach($subAdminList as $sa)
                    <option value="{{$sa->id}}">({{$sa->email}}) / {{$sa->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="masterId">Select Masters <sup class="text-danger">(*)</sup></label>
                <select name="masterId" id="masterId" class="form-control">
                    <option value="">---Select---</option>                    
                </select>
            </div>
            
            <div class="col-md-3 form-group">
                <label for="superAgentId">Select Super Agent <sup class="text-danger">(*)</sup></label>
                <select name="superAgentId" id="superAgentId" class="form-control">
                    <option value="">---Select---</option>                    
                </select>
            </div>
            
            <div class="col-md-3 form-group">
                <label for="agentId">Select Agent <sup class="text-danger">(*)</sup></label>
                <select name="agentId" id="agentId" class="form-control">
                    <option value="">---Select---</option>                    
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="userName">Name <sup class="text-danger">(*)</sup></label>
                <input name="name" value="{{old('name')}}" class="form-control" id="userName">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="userContact">Contact <sup class="text-danger">(*)</sup></label>
                <input type="text" name="contact" value="{{old('contact')}}" class="form-control" id="userContact" maxlength="10">
                @error('contact')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="userEmail">CLIENT ID <sup class="text-danger">(*)</sup></label>
                <input type="text" name="email" value="{{old('email')}}" class="form-control" id="userEmail">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="userPassword">Password <sup class="text-danger">(*)</sup></label>
                <input name="password" class="form-control" id="userPassword">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label>Status<sup class="text-danger">(*)</sup></label>
                <div class="border" style="display: flex;">
                    <div class="col-md-6 custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-success" type="radio" id="customRadio1" name="is_active" value="1">
                        <label for="customRadio1" class="custom-control-label">Active</label>
                    </div>
                    <div class="col-md-6 custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-danger" type="radio" id="customRadio2" name="is_active" value="0" checked>
                        <label for="customRadio2" class="custom-control-label">Deactive</label>
                    </div>
                </div>
                @error('is_active')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="userState">State</label>
                <input name="state" value="{{old('state')}}" class="form-control" id="userState">
                @error('state')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="userCity">City</label>
                <input name="city" value="{{old('city')}}" class="form-control" id="userCity">
                @error('city')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="userZipcode">Postal / Zip Code</label>
                <input type="text" name="zipcode" value="{{old('zipcode')}}" class="form-control" id="userZipcode">
                @error('zipcode')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                <label for="userAddLine1">Address line 1</label>
                <textarea name="address_line1" class="form-control" id="userAddLine1">{{old('address_line1')}}</textarea>
                @error('address_line1')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                <label for="userAddLine2">Address line 2</label>
                <textarea name="address_line2" class="form-control" id="userAddLine2">{{old('address_line2')}}</textarea>
                @error('address_line2')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-indigo btn-flat btn-block">Submit</button>
        </div>
    </form>
</div>
<!-- /.card -->











@endsection

@section('javascript')
<script>
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                return true;
            }
        });
        $('#webForm').validate({
            rules: {
                subAdminId: { required: true },
                masterId: { required: true },
                superAgentId: { required: true },
                agentId: { required: true },
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 30
                },
                contact: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                email: {
                    required: true,
                    maxlength: 191,
                },
                is_active: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 191,
                },
                zipcode: {
                    minlength: 6,
                    maxlength: 6,
                    digits: true
                },
                address_line1: {
                    maxlength: 191
                },
                address_line2: {
                    maxlength: 191
                },
                state: {
                    maxlength: 191
                },
                city: {
                    maxlength: 191
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#subAdminId').on('change', function() {
            if ($(this).val() != '') {

                $.ajax({
                    url: "{{url('/getUsersByType')}}",
                    type: "GET",
                    data: {
                        parentId: $(this).val(),
                        utype: 'MASTER'
                    },
                    success: function(res) {
                        $('#masterId').html(res.result);
                    }

                });
            }
        });
        $('#masterId').on('change', function() {
            if ($(this).val() != '') {

                $.ajax({
                    url: "{{url('/getUsersByType')}}",
                    type: "GET",
                    data: {
                        parentId: $(this).val(),
                        utype: 'SUPER AGENT'
                    },
                    success: function(res) {
                        $('#superAgentId').html(res.result);
                    }
                });
            }
        });

        $('#superAgentId').on('change', function() {
            if ($(this).val() != '') {

                $.ajax({
                    url: "{{url('/getUsersByType')}}",
                    type: "GET",
                    data: {
                        parentId: $(this).val(),
                        utype: 'AGENT'
                    },
                    success: function(res) {
                        $('#agentId').html(res.result);
                    }
                });
            }
        });
    });
</script>

@endsection