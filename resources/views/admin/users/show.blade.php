@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Detail</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $user->USER_ID }}</p>
            <p><strong>Username:</strong> {{ $user->USERNAME }}</p>
            <p><strong>Full Name:</strong> {{ $user->FULL_NAME }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->ROLE) }}</p>

            @if($user->PROFILE_IMAGE)
                <p><strong>Profile Image:</strong><br>
                <img src="{{ asset('storage/'.$user->PROFILE_IMAGE) }}" alt="Profile Image" width="200"></p>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-3">Back to List</a>
    <a href="{{ route('admin.users.edit', $user->USER_ID) }}" class="btn btn-warning mt-3">Edit User</a>
</div>
@endsection
