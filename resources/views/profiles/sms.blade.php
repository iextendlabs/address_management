@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Message to User</h2>
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
    @if(isset($sms))
        @foreach($sms as $single_sms)
        @if($single_sms->type == "send")
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <textarea style="height: 160px; width: 90%; background-color: #ffffff;" class="form-control" disabled>{{ $single_sms->body }}</textarea>
                <span class="float-end">{{ $single_sms->created_at }}</span><br><br>
            </div>
        </div>
        @elseif($single_sms->type == "receive")
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="margin-left:500px ;">
                <textarea style="height: 160px; width: 90%; background-color: #d9fdd3;" class="form-control" disabled>{{ $single_sms->body }}</textarea>
                <span class="float-end">{{ $single_sms->created_at }}</span><br><br>
            </div>
        </div>
        @endif
        @endforeach
    @endif
    <form action="{{url('/sendSMS')}}" method="POST">
        @csrf
         <div class="row">
            <input type="hidden" name="number" value="{{ $profile->phoneMobile }}">
            <input type="hidden" name="profile_id" value="{{ $profile->id}}">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Message:</strong>
                        <textarea name="message" cols="30" rows="10" class="form-control" placeholder="Message" style="height: 200px; width: 100%;"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 15px !important;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection