@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h2>

    <form id="user-form" action="{{ route('admin.users.update', $user->USER_ID) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Username -->
        <div>
            <label for="USERNAME" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="USERNAME" id="USERNAME"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('USERNAME', $user->USERNAME) }}">
            @error('USERNAME') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <!-- Full Name -->
        <div>
            <label for="FULL_NAME" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="FULL_NAME" id="FULL_NAME"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('FULL_NAME', $user->FULL_NAME) }}">
            @error('FULL_NAME') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <!-- Role -->
        <div>
            <label for="ROLE" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="ROLE" id="ROLE"
                    class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Select role --</option>
                <option value="admin" {{ old('ROLE', $user->ROLE)=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="student" {{ old('ROLE', $user->ROLE)=='student' ? 'selected' : '' }}>Student</option>
            </select>
            @error('ROLE') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="PASSWORD" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-gray-500 text-sm">(Kosongkan jika tidak ingin diubah)</span></label>
            <input type="password" name="PASSWORD" id="PASSWORD"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('PASSWORD') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="PASSWORD_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="PASSWORD_confirmation" id="PASSWORD_confirmation"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Profile Image -->
        <div>
            <label for="PROFILE_IMAGE" class="block text-sm font-medium text-gray-700 mb-1">Profile Image</label>
            @if($user->PROFILE_IMAGE)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$user->PROFILE_IMAGE) }}" alt="Profile Image" class="w-32 h-32 object-cover rounded-md shadow">
                </div>
            @endif
            <input type="file" name="PROFILE_IMAGE" id="PROFILE_IMAGE" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Buttons -->
        <div class="flex items-center space-x-4 mt-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                Update
            </button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('user-form');

    form.addEventListener('submit', function(e) {
        let valid = true;

        const username = document.getElementById('USERNAME');
        const fullName = document.getElementById('FULL_NAME');
        const password = document.getElementById('PASSWORD');
        const passwordConfirm = document.getElementById('PASSWORD_confirmation');
        const role = document.getElementById('ROLE');
        const profile = document.getElementById('PROFILE_IMAGE');

        document.querySelectorAll('small.js-error').forEach(el => el.remove());

        [username, fullName, password, passwordConfirm, role, profile].forEach(el => {
            if(el) el.style.borderColor = '#d1d5db';
        });

        // ==== Username ====
        if(!username.value.trim()) {
            valid = false;
            username.style.borderColor = '#dc2626';
            username.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">Username is required</small>');
        } else if(username.value.length > 50) {
            valid = false;
            username.style.borderColor = '#dc2626';
            username.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">Max 50 characters</small>');
        }

        // ==== Full Name ====
        if(!fullName.value.trim()) {
            valid = false;
            fullName.style.borderColor = '#dc2626';
            fullName.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">Full Name is required</small>');
        } else if(fullName.value.length > 100) {
            valid = false;
            fullName.style.borderColor = '#dc2626';
            fullName.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">Max 100 characters</small>');
        }

        // ==== Password ====
        if(password.value.trim() && password.value.length < 6) {
            valid = false;
            password.style.borderColor = '#dc2626';
            password.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">Password must be at least 6 characters</small>');
        }

        // ==== Password confirm ====
        if(password.value.trim() && password.value !== passwordConfirm.value) {
            valid = false;
            passwordConfirm.style.borderColor = '#dc2626';
            passwordConfirm.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">Passwords do not match</small>');
        }

        // ==== Role ====
        if(!role.value || !['student','admin'].includes(role.value)) {
            valid = false;
            role.style.borderColor = '#dc2626';
            role.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">Role is required</small>');
        }

        // ==== Profile Image ====
        if(profile.files.length > 0) {
            const file = profile.files[0];
            const validTypes = ['image/jpeg','image/png','image/gif','image/webp'];
            if(!validTypes.includes(file.type)) {
                valid = false;
                profile.style.borderColor = '#dc2626';
                profile.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">File must be an image</small>');
            } else if(file.size > 2*1024*1024) {
                valid = false;
                profile.style.borderColor = '#dc2626';
                profile.insertAdjacentHTML('afterend','<small class="text-red-600 js-error">File size max 2MB</small>');
            }
        }

        if(!valid) e.preventDefault();
    });
});
</script>
