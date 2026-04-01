@extends('layouts.app')

@php
$tenant = request()->route('tenant');
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">


    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Productos
            </h1>
            <p class="text-sm text-gray-500">
                Gestiona los productos de tu negocio
            </p>
        </div>

        <button
            onclick="openCreateProductModal('{{ route('tenant.admin.products.store', $tenant) }}')"
            class=" inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
            + Nuevo Producto
        </button>
    </div>

        {{-- Buscador --}}
    {{-- Mejora el buscador para móvil --}}
    <div class="bg-white border border-gray-100 shadow-sm rounded-xl p-4 mb-6">
        <form method="GET" class="space-y-3 md:space-y-0 md:flex md:items-center md:gap-4">
            {{-- Input buscar --}}
            <div class="flex-1">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Buscar producto por nombre..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Select categorías --}}
            <div class="w-full md:w-60">
                <select name="category"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Todas las categorías</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ ($category ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 md:flex-none bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Buscar
                </button>
                <a href="{{ route('tenant.admin.products.index', $tenant) }}"
                    class="flex-1 md:flex-none text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    {{-- Mensaje éxito --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    {{-- Tabla --}}
    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
        {{-- Vista de tabla para desktop, vista de cards para móvil --}}
        
        {{-- Desktop: tabla --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Imagen</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Categoría</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('storage/default.jpg') }}"
                                alt="{{ $product->name }}"
                                class="w-14 h-14 object-cover rounded-lg border border-gray-200 shadow-sm">
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->description }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $product->category->name ?? 'Sin categoría' }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">${{ number_format($product->price ?? 0, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($product->is_available)
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Disponible</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-full">No disponible</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick='openEditProductModal(
                                    "{{ route("tenant.admin.products.update", [$tenant, $product->id]) }}",
                                    @json($product->name),
                                    @json($product->description),
                                    "{{ $product->price }}",
                                    "{{ $product->category_id }}",
                                    {{ $product->is_available ? "true" : "false" }}
                                )' class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">✏️ Editar</button>
                                
                                <button type="button" onclick="openDeleteModal(
                                    '{{ route('tenant.admin.products.destroy', [$tenant, $product->id]) }}',
                                    '{{ $product->name }}'
                                )" class="text-red-600 hover:text-red-800 text-sm font-medium">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">No hay productos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Móvil: vista de tarjetas --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($products as $product)
            <div class="p-4 space-y-3">
                {{-- Header con imagen y nombre --}}
                <div class="flex items-start gap-3">
                    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('storage/default.jpg') }}"
                        alt="{{ $product->name }}"
                        class="w-16 h-16 object-cover rounded-lg border border-gray-200 shadow-sm flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-medium text-gray-800 text-lg">{{ $product->name }}</h3>
                        @if($product->description)
                            <p class="text-sm text-gray-500 mt-1">{{ $product->description }}</p>
                        @endif
                    </div>
                </div>

                {{-- Detalles del producto --}}
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <span class="text-gray-500">Categoría:</span>
                        <span class="text-gray-800 font-medium block">{{ $product->category->name ?? 'Sin categoría' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Precio:</span>
                        <span class="text-gray-800 font-bold block text-lg">${{ number_format($product->price ?? 0, 2) }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Estado:</span>
                        <div class="mt-1">
                            @if($product->is_available)
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Disponible</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-full">No disponible</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Acciones --}}
                <div class="flex gap-3 pt-2 border-t border-gray-100">
                    <button type="button" onclick='openEditProductModal(
                        "{{ route("tenant.admin.products.update", [$tenant, $product->id]) }}",
                        @json($product->name),
                        @json($product->description),
                        "{{ $product->price }}",
                        "{{ $product->category_id }}",
                        {{ $product->is_available ? "true" : "false" }}
                    )' class="flex-1 text-center bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-3 py-2 rounded-lg text-sm font-medium transition">
                        ✏️ Editar
                    </button>
                    <button type="button" onclick="openDeleteModal(
                        '{{ route('tenant.admin.products.destroy', [$tenant, $product->id]) }}',
                        '{{ $product->name }}'
                    )" class="flex-1 text-center bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded-lg text-sm font-medium transition">
                        🗑️ Eliminar
                    </button>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-500">
                No hay productos registrados.
            </div>
            @endforelse
        </div>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection


{{-- Modal --}}
@include('tenant.admin.products.partials.modal')

{{-- Modal Delete global --}}
@include('components.delete-modal')


@push('scripts')
<script>

function openCreateProductModal(actionUrl){

    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');

    document.getElementById('productModalTitle').innerText = 'Nuevo Producto';

    form.action = actionUrl;
    document.getElementById('productMethodField').innerHTML = '';

    form.reset();

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function openEditProductModal(actionUrl,name,description,price,categoryId,isAvailable){

    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');

    document.getElementById('productModalTitle').innerText = 'Editar Producto';

    form.action = actionUrl;

    document.getElementById('productMethodField').innerHTML =
        '<input type="hidden" name="_method" value="PUT">';

    document.getElementById('productName').value = name ?? '';
    document.getElementById('productDescription').value = description ?? '';
    document.getElementById('productPrice').value = price ?? '';
    document.getElementById('productCategory').value = categoryId ?? '';
    document.getElementById('productAvailable').checked = isAvailable;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeProductModal(){

    const modal = document.getElementById('productModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function openDeleteModal(actionUrl,name){

    const modal = document.getElementById('globalDeleteModal');
    const form = document.getElementById('globalDeleteForm');

    document.getElementById('globalDeleteName').innerText = name;

    form.action = actionUrl;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal(){

    const modal = document.getElementById('globalDeleteModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

</script>
@endpush