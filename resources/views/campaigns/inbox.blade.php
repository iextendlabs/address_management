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
                <h2>Campaign Inbox</h2>
            </div>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-lg-7 margin-tb">
            <table class="table table-bordered">
                @if(($data))
                @foreach ($data as $single_data)
                <tr>
                    <td><a href="campaignChat/{{ $single_data['campaign_id'] }}"><span style="font-weight: bolder; font-size: large; padding: 20px;">{{ $single_data['campaign'] }}</span></a><br><span class="float-end" style="font-size: small;">{{ $single_data['date'] }}</span>
                        <span style="padding-left: 40px; color: #595c5e;">{{ $single_data['sms'] }}</span>
                    </td>
                </tr>
                @endforeach
                @endif
            </table>
            </form>
        </div>
    </div>

@endsection