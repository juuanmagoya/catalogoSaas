@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
    {{-- Mensaje error --}}
    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    {{-- Mensaje éxito --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Planes
            </h1>
            <p class="text-sm text-gray-500">
                Gestiona los planes de suscripción del SaaS
            </p>
        </div>

        <button
            onclick="openCreatePlanModal('{{ route('admin.plans.store') }}')"
            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
            + Nuevo Plan
        </button>
    </div>



    {{-- Tabla --}}
    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Nombre
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Precio
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Duración
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Máx. Productos
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Tenants
                    </th>

                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">

                @forelse($plans as $plan)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- Nombre --}}
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $plan->name }}
                        </td>

                        {{-- Precio --}}
                        <td class="px-6 py-4 text-gray-700">
                            ${{ number_format($plan->price, 2) }}
                        </td>

                        {{-- Duración --}}
                        <td class="px-6 py-4 text-gray-700">
                            {{ $plan->duration_days }} días
                        </td>

                        {{-- Max products --}}
                        <td class="px-6 py-4 text-gray-700">

                            @if($plan->max_products)
                                {{ $plan->max_products }}
                            @else
                                <span class="text-green-600 font-medium">
                                    Ilimitado
                                </span>
                            @endif

                        </td>

                        {{-- Tenants usando el plan --}}
                        <td class="px-6 py-4 text-gray-700">
                            {{ $plan->tenants_count }}
                        </td>

                        {{-- Acciones --}}
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">

                                {{-- Editar --}}
                                <button
                                    type="button"
                                    onclick='openEditPlanModal(
                                        "{{ route("admin.plans.update", $plan->id) }}",
                                        @json($plan->name),
                                        "{{ $plan->price }}",
                                        "{{ $plan->duration_days }}",
                                        "{{ $plan->max_products }}"
                                    )'
                                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    ✏️ Editar
                                </button>

                                {{-- Eliminar --}}
                                <button
                                    type="button"
                                    onclick="openDeleteModal(
                                        '{{ route('admin.plans.destroy', [request()->route('slug'), $plan->id]) }}',
                                        '{{ $plan->name }}'
                                    )"
                                    class="inline-flex items-center gap-2 text-red-600 hover:text-red-800 text-sm font-medium transition">
                                    Eliminar
                                </button>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No hay planes registrados.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $plans->links() }}
    </div>

</div>
@endsection

@include('admin.plan.partials.modal')

@push('scripts')
<script>

function openCreatePlanModal(actionUrl)
{
    const modal = document.getElementById('planModal');
    const form = document.getElementById('planForm');

    document.getElementById('planModalTitle').innerText = 'Nuevo Plan';

    form.action = actionUrl;

    document.getElementById('planMethodField').innerHTML = '';

    form.reset();

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function openEditPlanModal(actionUrl, name, price, durationDays, maxProducts)
{
    const modal = document.getElementById('planModal');
    const form = document.getElementById('planForm');

    document.getElementById('planModalTitle').innerText = 'Editar Plan';

    form.action = actionUrl;

    document.getElementById('planMethodField').innerHTML =
        '<input type="hidden" name="_method" value="PUT">';

    document.getElementById('planName').value = name ?? '';
    document.getElementById('planPrice').value = price ?? '';
    document.getElementById('planDuration').value = durationDays ?? '';
    document.getElementById('planMaxProducts').value = maxProducts ?? '';

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePlanModal()
{
    const modal = document.getElementById('planModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

</script>
@endpush