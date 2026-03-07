@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Tenants
            </h1>
            <p class="text-sm text-gray-500">
                Gestiona los negocios registrados en el SaaS
            </p>
        </div>

        <button
            onclick="openCreateTenantModal('{{ route('admin.tenants.store') }}')"
            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
            + Nuevo Tenant
        </button>
    </div>


    {{-- Mensajes --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif


    {{-- Tabla --}}
    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Negocio
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Slug
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Plan
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Productos
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Estado
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Creado
                    </th>

                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">
                        Acciones
                    </th>
                </tr>
            </thead>


            <tbody class="bg-white divide-y divide-gray-100">

                @forelse($tenants as $tenant)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- Negocio --}}
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">
                                {{ $tenant->name }}
                            </div>
                        </td>

                        {{-- Slug --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $tenant->slug }}
                        </td>

                        {{-- Plan --}}
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $tenant->plan->name ?? '-' }}
                        </td>

                        {{-- Productos --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $tenant->products_count }}
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">

                            @if($tenant->status === 'active')
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                    Activo
                                </span>

                            @elseif($tenant->status === 'trial')
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                                    Trial
                                </span>

                            @elseif($tenant->status === 'suspended')
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                                    Suspendido
                                </span>

                            @else
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-full">
                                    Expirado
                                </span>
                            @endif

                        </td>

                        {{-- Fecha --}}
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $tenant->created_at->format('d/m/Y') }}
                        </td>


                        {{-- Acciones --}}
                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-4">

                                <button
                                    type="button"
                                    onclick='openEditTenantModal(
                                        "{{ route("admin.tenants.update", $tenant->id) }}",
                                        @json($tenant->name),
                                        "{{ $tenant->plan_id }}",
                                        "{{ $tenant->status }}"
                                    )'
                                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    ✏️ Editar
                                </button>


                                {{-- Eliminar --}}
                                <button
                                    type="button"
                                    onclick="openDeleteModal(
                                        '{{ route('admin.tenants.destroy', $tenant->id) }}',
                                        '{{ $tenant->name }}'
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
                            No hay tenants registrados.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Paginación --}}
    <div class="mt-6">
        {{ $tenants->links() }}
    </div>

</div>
@endsection


@include('admin.tenant.partials.modal')


@push('scripts')

<script>

function openCreateTenantModal(actionUrl) {

    const modal = document.getElementById('tenantModal');
    const form = document.getElementById('tenantForm');

    document.getElementById('tenantModalTitle').innerText = 'Nuevo Tenant';

    form.action = actionUrl;

    document.getElementById('tenantMethodField').innerHTML = '';

    form.reset();

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}



function openEditTenantModal(actionUrl, name, planId, status) {

    const modal = document.getElementById('tenantModal');
    const form = document.getElementById('tenantForm');

    document.getElementById('tenantModalTitle').innerText = 'Editar Tenant';

    form.action = actionUrl;

    document.getElementById('tenantMethodField').innerHTML =
        '<input type="hidden" name="_method" value="PUT">';

    document.getElementById('tenantName').value = name ?? '';
    document.getElementById('tenantPlan').value = planId ?? '';
    document.getElementById('tenantStatus').value = status ?? '';

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}


function closeTenantModal() {

    const modal = document.getElementById('tenantModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

</script>

@endpush