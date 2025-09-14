<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container">
            <a class="navbar-brand" href="#">My App</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
