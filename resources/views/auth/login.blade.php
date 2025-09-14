<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
    <h1>Login</h1>

    @if(session('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div>
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
