@extends('layouts.app')

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

        <button onclick="openCreateProductModal('{{ route('tenant.admin.products.store', request()->route('subdomain')) }}')"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
            + Nuevo Producto
        </button>
    </div>

    {{-- Mensaje éxito --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
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

                        {{-- Imagen --}}
                        <td class="px-6 py-4">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}"
                                     alt="{{ $product->name }}"
                                     class="w-14 h-14 object-cover rounded-lg border border-gray-200 shadow-sm">
                            @else
                                <div class="w-14 h-14 flex items-center justify-center bg-gray-100 rounded-lg border border-gray-200 text-gray-400 text-xs">
                                    Sin imagen
                                </div>
                            @endif
                        </td>

                        {{-- Nombre --}}
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">
                                {{ $product->name }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $product->description }}
                            </div>
                        </td>

                        {{-- Categoría --}}
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $product->category->name ?? 'Sin categoría' }}
                        </td>

                        {{-- Precio --}}
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                            ${{ number_format($product->price ?? 0, 2) }}
                        </td>

                        {{-- Estado --}}
                        <td class="px-6 py-4">
                            @if($product->is_available)
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                    Disponible
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-full">
                                    No disponible
                                </span>
                            @endif
                        </td>

                        {{-- Acciones --}}
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">

                                {{-- Editar --}}
                                <button
                                    type="button"
                                    onclick='openEditProductModal(
                                        "{{ route('tenant.admin.products.update', [request()->route('subdomain'), $product->id]) }}",
                                        @json($product->name),
                                        @json($product->description),
                                        "{{ $product->price }}",
                                        "{{ $product->category_id }}",
                                        {{ $product->is_available ? 'true' : 'false' }}
                                    )'
                                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    ✏️ Editar
                                </button>

                                {{-- Eliminar --}}
                                <button
                                    type="button"
                                    onclick="openDeleteModal(
                                        '{{ route('tenant.admin.products.destroy', [request()->route('subdomain'), $product->id]) }}',
                                        '{{ $product->name }}'
                                    )"
                                    class="inline-flex items-center gap-2 text-red-600 hover:text-red-800 text-sm font-medium transition">
                                    Eliminar
                                </button>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No hay productos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection

@include('tenant.admin.products.partials.modal')

@push('scripts')
<script>

function openCreateProductModal(actionUrl) {
    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');

    document.getElementById('productModalTitle').innerText = 'Nuevo Producto';
    form.action = actionUrl;

    document.getElementById('productMethodField').innerHTML = '';
    form.reset();

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function openEditProductModal(actionUrl, name, description, price, categoryId, isAvailable) {
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

function closeProductModal() {
    const modal = document.getElementById('productModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

</script>
@endpush