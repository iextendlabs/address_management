@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>SMS:</strong>
                {{ $campaign->sms_body }}
            </div>
            <strong>Recipient:</strong>
            <div class="form-group" style="padding-left:30px ">
                @foreach($recipients as $recipient)
                    @if($campaign->id == $recipient->campaign_id)
                    {{ $recipient->firstName }} {{ $recipient->lastName }} <b>({{ $recipient->phoneMobile }})</b> <br>
                    @endif
                @endforeach
            </div>
        </div>
    </div><hr>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
<script>
    var xValues = @json($body);
    var yValues = @json($total);
    var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#1e7145"
    ];

    new Chart("myChart", {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        title: {
        display: true,
        text: "Campaign Report"
        }
    }
    });
</script>
@endsection