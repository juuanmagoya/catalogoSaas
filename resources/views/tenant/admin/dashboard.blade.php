<!DOCTYPE html>
<html>
<head>
    <title>Panel del Negocio</title>
</head>
<body>

    <h1>Panel del Negocio</h1>

    <p>
        Bienvenido {{ auth()->user()->name }}
    </p>

    <nav>
        <ul>
            <li>
                <a href="{{ route('tenant.admin.categories.index', request()->route('subdomain')) }}">
                    Categorías
                </a>
            </li>
            <li>
                <a href="{{ route('tenant.admin.products.index', request()->route('subdomain')) }}">
                    Productos
                </a>
            </li>
        </ul>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>

</body>
</html>