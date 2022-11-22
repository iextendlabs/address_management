@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Profile</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                <a class="btn btn-primary" href="{{ route('profiles.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('profiles.update',$profile->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="firstName" value="{{ $profile->firstName }}" class="form-control" placeholder="First Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="lastName" value="{{ $profile->lastName }}" class="form-control" placeholder="Last Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Job Title:</strong>
                    <input type="text" name="jobTitle" value="{{ $profile->jobTitle }}" class="form-control" placeholder="Job Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company:</strong>
                    <input type="text" name="company" value="{{ $profile->company }}" class="form-control" placeholder="Company">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Employee Number:</strong>
                    <input type="number" name="employeeNumber" value="{{ $profile->employeeNumber }}" class="form-control" placeholder="Employee Number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Gender:</strong>
                    <select name="gender" id="gender" class="form-control">
                        @if($profile->gender == 1)
                        <option value="1" selected>Male</option>
                        <option value="0">Female</option>
                        @else
                        <option value="1">Male</option>
                        <option value="0" selected>Female</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department Number:</strong>
                    <input type="text" name="departmentNumber" value="{{ $profile->departmentNumber }}" class="form-control" placeholder="Department Number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department:</strong>
                    <input type="text" name="department" value="{{ $profile->department }}" class="form-control" placeholder="Department">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone (Mobile):</strong>
                    <input type="number" name="phoneMobile" value="{{ $profile->phoneMobile }}" class="form-control" placeholder="Phone (Mobile)">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone (Work):</strong>
                    <input type="text" name="phoneWork" value="{{ $profile->phoneWork }}" class="form-control" placeholder="Phone (Work)">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $profile->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Workgroup:</strong>
                    <input type="text" name="workgroup" value="{{ $profile->workgroup }}" class="form-control" placeholder="Workgroup">
                </div>
            </div><br><br><br>
            <hr>
            <h3>Work address:</h3>
            <input type="hidden" name="address_id" value="{{ $address->id }}">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Prefix:</strong>
                    <input type="text" name="prefix" value="{{ $address->prefix }}" class="form-control" placeholder="Prefix">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Number:</strong>
                    <input type="number" name="number" value="{{ $address->number }}" class="form-control" placeholder="Number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Street:</strong>
                    <input type="text" name="street" value="{{ $address->street }}" class="form-control" placeholder="Street">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>City \ Town:</strong>
                    <input type="text" name="city_town" value="{{ $address->city_town }}" class="form-control" placeholder="City \ Town">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Country:</strong>
                    <input type="text" name="country" value="{{ $address->country }}" class="form-control" placeholder="Country">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Postcode \ ZipCode:</strong>
                    <input type="text" name="postcode_zipcode" value="{{ $address->postcode_zipcode }}" class="form-control" placeholder="Postcode \ ZipCode">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 15px !important;">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection