@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Campaigns</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                @can('campaign-create')
                <a class="btn btn-success" href="{{ route('campaigns.create') }}"> Create New Campaign</a>
                @endcan
                <a class="btn btn-primary" href="{{url('/campaignInbox')}}">Inbox</a>
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
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($campaigns as $campaign)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $campaign->title }}</td>
            <td>
                <form action="{{ route('campaigns.destroy',$campaign->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('campaigns.show',$campaign->id) }}">Show</a>
                    @can('campaign-edit')
                    <a class="btn btn-primary" href="{{ route('campaigns.edit',$campaign->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('campaign-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $campaigns->links() !!}
@endsection