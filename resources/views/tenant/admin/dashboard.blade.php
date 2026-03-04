@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-semibold mb-8 tracking-wide text-neutral-800"
    style="font-family: 'Playfair Display', serif;">
    Panel del Negocio
</h1>

<p class="mb-8 text-neutral-600">
    Bienvenido, <span class="font-semibold text-neutral-900">{{ auth()->user()->name }}</span>
</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Categorías --}}
    <a href="{{ route('tenant.admin.categories.index', request()->route('subdomain')) }}"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border-t-4 border-amber-600 block">

        <h3 class="text-neutral-500 text-sm uppercase tracking-wider">
            Gestión
        </h3>

        <p class="text-xl font-semibold mt-4 text-neutral-900">
            Categorías
        </p>

        <p class="text-sm text-neutral-500 mt-2">
            Administra las categorías de tu carta digital.
        </p>

    </a>

    {{-- Productos --}}
    <a href="{{ route('tenant.admin.products.index', request()->route('subdomain')) }}"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border-t-4 border-amber-600 block">

        <h3 class="text-neutral-500 text-sm uppercase tracking-wider">
            Gestión
        </h3>

        <p class="text-xl font-semibold mt-4 text-neutral-900">
            Productos
        </p>

        <p class="text-sm text-neutral-500 mt-2">
            Administra los productos visibles en tu catálogo.
        </p>

    </a>

    {{-- Configuración --}}
    <a href="#"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border-t-4 border-amber-600 block">

        <h3 class="text-neutral-500 text-sm uppercase tracking-wider">
            Personalización
        </h3>

        <p class="text-xl font-semibold mt-4 text-neutral-900">
            Configuración
        </p>

        <p class="text-sm text-neutral-500 mt-2">
            Configura tu catálogo público y datos del negocio.
        </p>

    </a>

</div>

@endsection