<!DOCTYPE html>
<html>
<head>
    <title>Admin Global - SaaS</title>
</head>
<body>

    <h1>Panel Global SaaS</h1>

    <p>Bienvenido {{ auth()->user()->name }}</p>

    <ul>
        <li>Gestión de Tenants</li>
        <li>Gestión de Planes</li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>

</body>
</html>