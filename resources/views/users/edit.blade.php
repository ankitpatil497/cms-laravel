@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">My profile</div>

    <div class="card-body">
        <form action="{{route('user.update-profile')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about" id="about" class="form-control" cols="5" rows="5">{{$user->about}}</textarea>
            </div>
            <buttton class="btn btn-success" type="submit">Update Profile</buttton>
        </form>

    </div>
</div>
@endsection
