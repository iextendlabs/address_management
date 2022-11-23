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
    <div class="row">
        <div class="col-lg-9 margin-tb">
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
        </div>
        <div class="col-lg-3 margin-tb" style="border: 1px solid #dee2e6; border-radius: 10px; padding-top: 10px; ">
            <form action="{{url('/filter')}}" method="POST" id="filter">
                @csrf
               <h3>Filter</h3><hr>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Select Field:</strong>
                        <select name="field" id="field" class="form-control" >
                            <option></option>
                                @foreach($fields as $val => $field) {
                                    @if(isset($old_data))
                                        @if( $val  == $old_data['field'])
                                            <option value="{{ $val }}" selected>{{ $field }}</option>
                                        @else
                                            <option value="{{ $val }}">{{ $field }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $val }}">{{ $field }}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Enter Value:</strong>
                        <input type="text" name="value" value="@if(isset($old_data)){{ $old_data['value'] }}@endif" class="form-control" placeholder="Enter Value">
                    </div>
                </div>
                <button type="submit" form="filter" class="btn btn-info" style="margin-top: 15px !important;">Filter</button>
            </form>
        </div>
    </div>
    {!! $profiles->links() !!}
@endsection