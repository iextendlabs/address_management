@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Profile</h2>
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
    <form action="{{ route('profiles.store') }}" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="firstName" value="{{ old('firstName') }}" class="form-control" placeholder="First Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="lastName" value="{{ old('lastName') }}" class="form-control" placeholder="Last Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Job Title:</strong>
                    <input type="text" name="jobTitle" value="{{ old('jobTitle') }}" class="form-control" placeholder="Job Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company:</strong>
                    <input type="text" name="company" value="{{ old('company') }}" class="form-control" placeholder="Company">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Employee Number:</strong>
                    <input type="number" name="employeeNumber" value="{{ old('employeeNumber') }}" class="form-control" placeholder="Employee Number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Gender:</strong>
                    <select name="gender" id="gender" class="form-control" >
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department Number:</strong>
                    <input type="text" name="departmentNumber" value="{{ old('departmentNumber') }}" class="form-control" placeholder="Department Number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department:</strong>
                    <input type="text" name="department" value="{{ old('department') }}" class="form-control" placeholder="Department">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone (Mobile):</strong>
                    <input type="number" name="phoneMobile" value="{{ old('phoneMobile') }}" class="form-control" placeholder="Phone (Mobile)">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone (Work):</strong>
                    <input type="text" name="phoneWork" value="{{ old('phoneWork') }}" class="form-control" placeholder="Phone (Work)">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Workgroup:</strong>
                    <input type="text" name="workgroup" value="{{ old('workgroup') }}" class="form-control" placeholder="Workgroup">
                </div>
            </div><br><br><br>
            <hr>
            <h3>Work address:</h3>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Prefix:</strong>
                    <input type="text" name="prefix" value="{{ old('prefix') }}" class="form-control" placeholder="Prefix">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Number:</strong>
                    <input type="number" name="number" value="{{ old('number') }}" class="form-control" placeholder="Number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Street:</strong>
                    <input type="text" name="street" value="{{ old('street') }}" class="form-control" placeholder="Street">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>City \ Town:</strong>
                    <input type="text" name="city_town" value="{{ old('city_town') }}" class="form-control" placeholder="City \ Town">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Country:</strong>
                    <input type="text" name="country" value="{{ old('country') }}" class="form-control" placeholder="Country">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Postcode \ ZipCode:</strong>
                    <input type="text" name="postcode_zipcode" value="{{ old('postcode_zipcode') }}" class="form-control" placeholder="Postcode \ ZipCode">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 15px !important;">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <p class="text-center text-primary"><small>By iextendlabs.com</small></p>
@endsection