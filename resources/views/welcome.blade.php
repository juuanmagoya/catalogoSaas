<!DOCTYPE html>
<html>
<head>
    <title>Prueba SaaS</title>
</head>
<body>

<h1>Prueba de Categorías</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<h2>Crear Categoría</h2>

<form method="POST" action="">
    @csrf
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="text" name="description" placeholder="Descripción">
    <label>
        Activa
        <input type="checkbox" name="is_active" value="1">
    </label>
    <button type="submit">Crear</button>
</form>

<hr>

<h2>Listado</h2>

@foreach($categories ?? [] as $category)
    <div style="margin-bottom:10px;">
        <strong>{{ $category->name }}</strong>
        ({{ $category->slug }})
        
        <form method="POST"
            action="{{ route('tenant.admin.categories.destroy', [
                'subdomain' => request()->route('subdomain'),
                'categoryId' => $category->id
            ]) }}"
            style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </div>
@endforeach

</body>
</html>