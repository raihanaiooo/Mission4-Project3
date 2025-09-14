@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="USERNAME">Username</label>
            <input type="text" name="USERNAME" class="form-control" value="{{ old('USERNAME') }}" required>
            @error('USERNAME') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="FULL_NAME">Full Name</label>
            <input type="text" name="FULL_NAME" class="form-control" value="{{ old('FULL_NAME') }}" required>
            @error('FULL_NAME') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="ROLE">Role</label>
            <select name="ROLE" class="form-control" required>
                <option value="student" {{ old('ROLE')=='student' ? 'selected' : '' }}>Student</option>
                <option value="admin" {{ old('ROLE')=='admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('ROLE') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="PASSWORD">Password</label>
            <input type="password" name="PASSWORD" class="form-control" required>
            @error('PASSWORD') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="PASSWORD_confirmation">Confirm Password</label>
            <input type="password" name="PASSWORD_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="PROFILE_IMAGE">Profile Image</label>
            <input type="file" name="PROFILE_IMAGE" class="form-control">
            @error('PROFILE_IMAGE') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
