@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Campaign Chat</h2>
            </div>
        </div>
    </div><hr>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <h5><u><b>Campaign Title:</b></u> {{ $campaign->title }}</h5>
                <textarea style="height: 160px; width: 90%; background-color: #ffffff;" class="form-control" disabled>{{ $campaign->sms_body }}</textarea>
                <span class="float-end">{{ $campaign->created_at }}</span><br><br>
            </div>
        </div>
    @if(isset($sms))
        @foreach($sms as $single_sms)
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="margin-left:500px ;">
                <u><b><span>{{ $single_sms->firstName }} {{ $single_sms->lastName }}</span></b></u>
                <textarea style="height: 160px; width: 90%; background-color: #d9fdd3;" class="form-control" disabled>{{ $single_sms->body }}</textarea>
                <span class="float-end">{{ $single_sms->created_at }}</span><br><br>
            </div>
        </div>
        @endforeach
    @endif
@endsection