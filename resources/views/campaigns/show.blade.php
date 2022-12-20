@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Campaign</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                <a class="btn btn-primary" href="{{ route('campaigns.index') }}"> Back</a>
            </div>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="font-size: large;">
                <strong>Campaign Title:</strong>
                {{ $campaign->title }}
                
            </div>
        </div>
    </div><hr>
    @if(isset($campaignSMS))
    @foreach($campaignSMS as $singleSMS)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>SMS:</strong>
                {{ $singleSMS->sms_body }}
            </div>
            <strong>Recipient:</strong>
            <div class="form-group" style="padding-left:30px ">
                @foreach($recipients as $recipient)
                    @if($singleSMS->id == $recipient->campaign_sms_id)
                    {{ $recipient->firstName }} {{ $recipient->lastName }} <b>({{ $recipient->phoneMobile }})</b> <br>
                    @endif
                @endforeach
            </div>
        </div>
    </div><hr>
    @endforeach
    @endif
@endsection