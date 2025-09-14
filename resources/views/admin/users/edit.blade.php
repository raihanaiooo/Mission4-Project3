@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <form action="{{ route('admin.users.update', $user->USER_ID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="USERNAME" id="username" class="form-control" value="{{ old('USERNAME', $user->USERNAME) }}" required>
            @error('USERNAME') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Full Name -->
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="FULL_NAME" id="full_name" class="form-control" value="{{ old('FULL_NAME', $user->FULL_NAME) }}" required>
            @error('FULL_NAME') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="EMAIL" id="email" class="form-control" value="{{ old('EMAIL', $user->EMAIL) }}" required>
            @error('EMAIL') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="ROLE" id="role" class="form-control" required>
                <option value="admin" {{ old('ROLE', $user->ROLE) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="student" {{ old('ROLE', $user->ROLE) == 'student' ? 'selected' : '' }}>Student</option>
            </select>
            @error('ROLE') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password <small>(Kosongkan jika tidak ingin diubah)</small></label>
            <input type="password" name="PASSWORD" id="password" class="form-control">
            @error('PASSWORD') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Profile Image -->
        <div class="mb-3">
            <label for="profile_image" class="form-label">Profile Image</label><br>
            @if($user->PROFILE_IMAGE)
                <img src="{{ asset('storage/'.$user->PROFILE_IMAGE) }}" alt="Profile Image" width="120" class="mb-2"><br>
            @endif
            <input type="file" name="PROFILE_IMAGE" id="profile_image" class="form-control">
            @error('PROFILE_IMAGE') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
