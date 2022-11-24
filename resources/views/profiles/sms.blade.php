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
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('fail'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
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
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            @if(isset($sms))
                @foreach($sms as $single_sms)
                    <textarea style="height: 160px; width: 90%;" class="form-control" disabled>{{ $single_sms->body }}</textarea>
                    @if($single_sms->status == 'success')
                        <span class="alert alert-success" style="--bs-alert-padding-y:0.5rem">Successfully send</span>
                    @else
                        <span class="alert alert-danger" style="--bs-alert-padding-y:0.5rem">Failed to send</span>
                    @endif
                    <span class="float-end">{{ $single_sms->created_at }}</span><br><br>
                @endforeach
            @endif
        </div>
    </div>
    <form action="{{url('/sendSMS')}}" method="POST">
        @csrf
         <div class="row">
            <input type="hidden" name="number" value="{{ $profile->phoneMobile }}">
            <input type="hidden" name="profile_id" value="{{ $profile->id}}">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Message:</strong>
                        <textarea name="message" cols="30" rows="10" class="form-control" placeholder="Message" style="height: 200px; width: 100%;">{{ old('firstName') }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 15px !important;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection