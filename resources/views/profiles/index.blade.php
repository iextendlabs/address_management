@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Profiles</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                @can('profile-create')
                <a class="btn btn-success" href="{{ route('profiles.create') }}"> Create New Profile</a>
                @endcan
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($profiles as $profile)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $profile->firstName }}</td>
            <td>{{ $profile->lastName }}</td>
            <td>
                <form action="{{ route('profiles.destroy',$profile->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('profiles.show',$profile->id) }}">Show</a>
                    @can('profile-edit')
                    <a class="btn btn-primary" href="{{ route('profiles.edit',$profile->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('profile-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $profiles->links() !!}
    <p class="text-center text-primary"><small>By iextendlabs.com</small></p>
@endsection