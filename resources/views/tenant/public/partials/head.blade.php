<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $tenant->name }}</title>

@vite(['resources/css/app.css'])
<style>

@keyframes scaleIn{

from{
opacity:0;
transform:scale(.9);
}

to{
opacity:1;
transform:scale(1);
}

}

.animate-scaleIn{
animation:scaleIn .25s ease;
}

/* Estilos base de los botones de categoría */
.category-btn {
    background-color: #1e1e1e;
    color: white;
    border: 1px solid rgba(184, 134, 11, 0.4);
    padding: 0.625rem 1.25rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

/* Efecto hover para desktop */
@media (hover: hover) {
    .category-btn:hover {
        background-color: #b8860b;
        color: black;
        border-color: #b8860b;
        box-shadow: 0 8px 20px rgba(184, 134, 11, 0.3);
    }
}

/* Efecto active (touch) para mobile */
.category-btn:active {
    transform: scale(0.96);
    background-color: #b8860b;
    color: black;
    border-color: #b8860b;
    transition: all 0.1s ease;
}

/* Estilo para botón activo/seleccionado */
.category-btn.active {
    background-color: #b8860b;
    color: black;
    border-color: #b8860b;
    box-shadow: 0 8px 20px rgba(184, 134, 11, 0.3);
}


</style>
</head>