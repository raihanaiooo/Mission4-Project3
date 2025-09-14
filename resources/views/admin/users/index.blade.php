@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Users</h2>

    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-2">Tambah User</a>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Profile</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->USER_ID }}</td>
                <td>{{ $user->USERNAME }}</td>
                <td>{{ $user->FULL_NAME }}</td>
                <td>{{ $user->ROLE }}</td>
                <td>
                    @if($user->PROFILE_IMAGE)
                        <img src="{{ asset('storage/'.$user->PROFILE_IMAGE) }}" width="60">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $user->USER_ID) }}">Detail</a> |
                    <a href="{{ route('admin.users.edit', $user->USER_ID) }}">Edit</a> |
                    <form action="{{ route('admin.users.destroy', $user->USER_ID) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
