@extends('layouts.app')
@section('content')
<style>
    a{
        text-decoration: none;
        color: #000;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>SMS Response</h2>
            </div>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-lg-7 margin-tb">
            <table class="table table-bordered">
                @if(($sms_response))
                @foreach ($sms_response as $single_data)
                <tr>
                    <td><span style="font-weight: bolder; font-size: large; padding: 20px;">{{ $single_data['from'] }}</span><br><span class="float-end" style="font-size: small;">{{ $single_data['created_at'] }}</span>
                        <span style="padding-left: 40px; color: #595c5e;">{{ $single_data['body'] }}</span>
                    </td>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
        {!! $sms_response->links() !!}
    </div>

@endsection