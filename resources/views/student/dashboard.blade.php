<!doctype html><html><head><meta charset="utf-8"><title>Student Dashboard</title></head><body>
    <h1>Student Dashboard</h1>
    <p>Halo, {{ session('user_name') }} ({{ session('user_role') }})</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body></html>
