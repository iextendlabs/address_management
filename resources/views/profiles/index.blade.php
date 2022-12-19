@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Profiles</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                @can('profile-create')
                    <a class="btn btn-success" href="{{ route('profiles.create') }}"> Create New Profile</a>
                @endcan
                @can('profile-sms')
                    <a class="btn btn-primary" href="{{url('/inbox')}}">Inbox</a>
                @endcan
            </div>
        </div>
    </div><hr>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('fail'))
        <div class="alert alert-danger">
            <span>{{ $message }}</span>
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{url('/campaignSMS')}}" method="POST" id="sms" class="form-group">
    <div id="smsButton" style="display: none; padding: 10px;">
        <div class="row">
            <div class="col-xs-5 col-sm-5 col-md-5">
                <div class="form-group" style="padding-bottom: 20px;">
                    <strong>Campaigns:</strong>
                    <select name="campaign" id="campaign" class="form-control">
                        @if(isset($campaigns))
                        @foreach($campaigns as $campaign)
                        <option value="{{ $campaign->id }}">{{ $campaign->title }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <strong>Message:</strong>
                    <textarea name="message" rows="5" class="form-control" placeholder="Message"></textarea>
                </div>
                <button type="submit" form="sms" class="btn btn-info" style="margin: 15px;">SMS</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 margin-tb">
            @csrf
            <table class="table table-bordered">
                <tr>
                    @can('profile-sms')<th></th>@endcan
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($profiles as $profile)
                <tr>
                    @can('profile-sms')
                    <th>
                        <input type="checkbox" name="ids[{{ $i }}]" class="smsId" value="{{ $profile->id }}">
                    </th>
                    @endcan
                    <td>{{ ++$i }}</td>
                    <td>{{ $profile->firstName }}</td>
                    <td>{{ $profile->lastName }}</td>
                    <td>
                            <a class="btn btn-info" href="{{ route('profiles.destroy',$profile->id) }}">Show</a>
                            @can('profile-edit')
                            <a class="btn btn-primary" href="{{ route('profiles.edit',$profile->id) }}">Edit</a>
                            @endcan
                            @csrf
                            @can('profile-delete')
                            <a class="btn btn-danger" href="profileDestroy/{{$profile->id }}">Delete</a>
                            @endcan
                            @can('profile-sms')
                            <a class="btn btn-primary" href="sms/{{ $profile->id }}">SMS</a>
                            @endcan
                    </td>
                </tr>
                @endforeach
            </table>
            </form>
            {!! $profiles->links() !!}
        </div>
        <div class="col-lg-3 margin-tb" style="border: 1px solid #dee2e6; border-radius: 10px; padding-top: 10px; ">
            <form action="{{url('/filter')}}" method="POST" id="filter">
                @csrf
               <h3>Filter</h3><hr>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Select Field:</strong>
                        <select name="field" id="field" class="form-control" >
                            <option></option>
                                @foreach($fields as $val => $field) {
                                    @if(isset($old_data))
                                        @if( $val  == $old_data['field'])
                                            <option value="{{ $val }}" selected>{{ $field }}</option>
                                        @else
                                            <option value="{{ $val }}">{{ $field }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $val }}">{{ $field }}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Enter Value:</strong>
                        <input type="text" name="value" value="@if(isset($old_data)){{ $old_data['value'] }}@endif" class="form-control" placeholder="Enter Value">
                    </div>
                </div>
                <button type="submit" form="filter" class="btn btn-info" style="margin-top: 15px !important;">Filter</button>
            </form>
        </div>
    </div>
    
<script>
    $(document).ready(function(){
    $(".smsId").click(function(){
        $('#smsButton').css('display','inline')
    });
    });
</script>
@endsection