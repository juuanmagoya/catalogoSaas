@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Categorías
            </h1>
            <p class="text-sm text-gray-500">
                Gestiona las categorías de tu negocio
            </p>
        </div>

        <button onclick="openCreateModal('{{ route('tenant.admin.categories.store', request()->route('subdomain')) }}')"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
            + Nueva Categoría
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Imagen
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Nombre
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Productos
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Estado
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            @if($category->image_path)
                                <img src="{{ asset('storage/' . $category->image_path) }}"
                                    alt="{{ $category->name }}"
                                    class="w-14 h-14 object-cover rounded-lg border border-gray-200 shadow-sm">
                            @else
                                <div class="w-14 h-14 flex items-center justify-center bg-gray-100 rounded-lg border border-gray-200 text-gray-400 text-xs">
                                    Sin imagen
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">
                                {{ $category->name }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $category->description }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $category->products_count ?? 0 }}
                        </td>

                        <td class="px-6 py-4">
                            @if($category->is_active)
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                    Activa
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-full">
                                    Inactiva
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">

                                {{-- Editar --}}
                                <a href="#"
                                onclick="openEditModal(
                                    '{{ route('tenant.admin.categories.update', [request()->route('subdomain'), $category->id]) }}',
                                    '{{ $category->name }}',
                                    '{{ $category->description }}',
                                    {{ $category->is_active ? 'true' : 'false' }}
                                )"
                                class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    ✏️ Editar
                                </a>

                                {{-- Eliminar --}}
                                <button
                                    type="button"
                                    onclick="openDeleteModal(
                                        '{{ route('tenant.admin.categories.destroy', [request()->route('subdomain'), $category->id]) }}',
                                        '{{ $category->name }}'
                                    )"
                                    class="inline-flex items-center gap-2 text-red-600 hover:text-red-800 text-sm font-medium transition"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-1-3H10a1 1 0 00-1 1v2h6V5a1 1 0 00-1-1z"/>
                                    </svg>
                                    Eliminar
                                </button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            No hay categorías registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $categories->links() }}
    </div>

</div>
@endsection

@include('tenant.admin.categories.partials.modal')

@push('scripts')
<script>
function openCreateModal(actionUrl) {
    const modal = document.getElementById('categoryModal');
    const form = document.getElementById('categoryForm');

    document.getElementById('modalTitle').innerText = 'Nueva Categoría';
    form.action = actionUrl;
    document.getElementById('methodField').innerHTML = '';
    form.reset();

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function openEditModal(actionUrl, name, description, isActive) {
    const modal = document.getElementById('categoryModal');
    const form = document.getElementById('categoryForm');

    document.getElementById('modalTitle').innerText = 'Editar Categoría';
    form.action = actionUrl;

    document.getElementById('methodField').innerHTML =
        '<input type="hidden" name="_method" value="PUT">';

    document.getElementById('categoryName').value = name;
    document.getElementById('categoryDescription').value = description ?? '';
    document.getElementById('categoryActive').checked = isActive;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeCategoryModal() {
    const modal = document.getElementById('categoryModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endpush