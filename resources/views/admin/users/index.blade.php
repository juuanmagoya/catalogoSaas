@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Usuarios
            </h1>
            <p class="text-sm text-gray-500">
                Gestiona los propietarios de los negocios registrados en el SaaS
            </p>
        </div>

        <button
            type="button"
            onclick="openCreateUserModal('{{ route('admin.users.store') }}')"
            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
            + Nuevo Usuario
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

    {{-- Errores de validación --}}
    @if($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            <p class="font-semibold mb-1">
                Revisá los siguientes errores:
            </p>

            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tabla --}}
    <div class="bg-white shadow-sm rounded-xl overflow-x-auto border border-gray-100">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Usuario
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Email
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Tenant
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Rol
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

                @forelse($users as $user)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- Nombre --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-800">
                                {{ $user->name }}
                            </div>
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $user->email }}
                        </td>

                        {{-- Tenant --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $user->tenant?->name ?? 'Sin tenant' }}
                        </td>

                        {{-- Rol --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->role === 'owner')
                                <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">
                                    Owner
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded-full">
                                    {{ ucfirst($user->role) }}
                                </span>
                            @endif
                        </td>

                        {{-- Fecha --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->created_at?->format('d/m/Y') ?? '-' }}
                        </td>

                        {{-- Acciones --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex justify-end gap-4">

                                {{-- Editar --}}
                                <button
                                    type="button"
                                    onclick="openEditUserModal(
                                        '{{ route('admin.users.update', $user->id) }}',
                                        @js($user->name),
                                        @js($user->email),
                                        @js($user->tenant_id)
                                    )"
                                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    ✏️ Editar
                                </button>

                                {{-- Eliminar --}}
                                <button
                                    type="button"
                                    onclick="openDeleteModal(
                                        '{{ route('admin.users.destroy', $user->id) }}',
                                        @js($user->name)
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
                            No hay usuarios registrados.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>
@endsection

{{-- Modal de usuarios --}}
@include('admin.users.partials.modal')

@push('scripts')
<script>
    function openCreateUserModal(actionUrl) {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');

        form.reset();
        form.action = actionUrl;

        document.getElementById('userModalTitle').innerText = 'Nuevo Usuario';
        document.getElementById('userMethodField').innerHTML = '';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function openEditUserModal(actionUrl, name, email, tenantId) {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');

        form.reset();
        form.action = actionUrl;

        document.getElementById('userModalTitle').innerText = 'Editar Usuario';

        document.getElementById('userMethodField').innerHTML =
            '<input type="hidden" name="_method" value="PUT">';

        document.getElementById('userName').value = name ?? '';
        document.getElementById('userEmail').value = email ?? '';
        document.getElementById('userTenant').value = tenantId ?? '';

        // La contraseña no se carga al editar.
        document.getElementById('userPassword').value = '';
        document.getElementById('userPasswordConfirmation').value = '';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeUserModal() {
        const modal = document.getElementById('userModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush