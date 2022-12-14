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
                <h2>Inbox</h2>
            </div>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <table class="table table-bordered">
                @if(($data))
                @foreach ($data as $single_data)
                <tr>
                    <td><a href="sms/{{ $single_data['profile_id'] }}"><span style="font-weight: bolder; font-size: large; padding: 20px;">{{ $single_data['profile'] }}</span></a><br>
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