<!DOCTYPE html>
<html>
<head>
    <title>Home User</title>
</head>
<body>
    <h1>Benvingut {{ Auth::user()->nom }}</h1>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Tancar sessió</button>
    </form>
</body>
</html>
