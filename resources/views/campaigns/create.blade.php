@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Campaign</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                <a class="btn btn-primary" href="{{ route('campaigns.index') }}"> Back</a>
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
    <form action="{{ route('campaigns.store') }}" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title') }}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Message:</strong>
                    <textarea name="message" cols="30" rows="10" class="form-control" placeholder="Message" style="height: 200px; width: 100%;">{{ old('message') }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Recipient:</strong>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Filter Recipient">
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Number</th>
                        </tr>
                        @foreach ($profiles as $profile)
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[{{ ++$i }}]" class="smsId" value="{{ $profile->id }}">
                            </td>
                            <td>{{ $profile->firstName }} {{ $profile->lastName }}</td>
                            <td>{{ $profile->phoneMobile }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 15px !important;">
                <button type="submit" class="btn btn-primary">Submit and Send</button>
            </div>
        </div>
    </form>
<script>
$(document).ready(function(){
    $("#search").keyup(function(){
        var value = $(this).val().toLowerCase();
        
        $("table tr").hide();

        $("table tr").each(function() {

            $row = $(this);

            var name = $row.find("td:first").next().text().toLowerCase();

            var number = $row.find("td:last").text().toLowerCase();

            if (name.indexOf(value) != -1) {
                $(this).show();
            }else if(number.indexOf(value) != -1) {
                $(this).show();
            }
        });
    });
});
</script>
@endsection