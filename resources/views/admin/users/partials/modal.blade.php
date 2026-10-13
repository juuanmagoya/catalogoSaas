{{-- Modal de usuarios --}}
<div
    id="userModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-6"
>
    <div class="w-full max-w-lg bg-white rounded-xl shadow-xl overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h2
                id="userModalTitle"
                class="text-xl font-bold text-gray-800"
            >
                Nuevo Usuario
            </h2>

            <button
                type="button"
                onclick="closeUserModal()"
                class="text-gray-400 hover:text-gray-700 text-2xl leading-none"
                aria-label="Cerrar modal"
            >
                &times;
            </button>
        </div>

        {{-- Formulario --}}
        <form
            id="userForm"
            action="{{ route('admin.users.store') }}"
            method="POST"
        >
            @csrf

            {{-- Campo para PUT al editar --}}
            <div id="userMethodField"></div>

            <div class="px-6 py-5 space-y-4">

                {{-- Nombre --}}
                <div>
                    <label
                        for="userName"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Nombre completo
                    </label>

                    <input
                        type="text"
                        id="userName"
                        name="name"
                        required
                        maxlength="255"
                        autocomplete="name"
                        value="{{ old('name') }}"
                        placeholder="Ej. Juan Pérez"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >

                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label
                        for="userEmail"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        id="userEmail"
                        name="email"
                        required
                        maxlength="255"
                        autocomplete="email"
                        value="{{ old('email') }}"
                        placeholder="usuario@ejemplo.com"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >

                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tenant --}}
                <div>
                    <label
                        for="userTenant"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Negocio (tenant)
                    </label>

                    <select
                        id="userTenant"
                        name="tenant_id"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                        <option value="">Seleccioná un negocio</option>

                        @foreach($tenants as $tenant)
                            <option
                                value="{{ $tenant->id }}"
                                @selected((string) old('tenant_id') === (string) $tenant->id)
                            >
                                {{ $tenant->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('tenant_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div>
                    <label
                        for="userPassword"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Contraseña
                    </label>

                    <input
                        type="password"
                        id="userPassword"
                        name="password"
                        minlength="8"
                        autocomplete="new-password"
                        placeholder="Mínimo 8 caracteres"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >

                    <p id="userPasswordHelp" class="text-xs text-gray-500 mt-1">
                        Obligatoria al crear el usuario.
                    </p>

                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmación de contraseña --}}
                <div>
                    <label
                        for="userPasswordConfirmation"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Confirmar contraseña
                    </label>

                    <input
                        type="password"
                        id="userPasswordConfirmation"
                        name="password_confirmation"
                        minlength="8"
                        autocomplete="new-password"
                        placeholder="Repetí la contraseña"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>

                {{-- Rol informativo --}}
                <div class="bg-indigo-50 border border-indigo-100 rounded-lg px-4 py-3">
                    <p class="text-sm font-medium text-indigo-800">
                        Rol: Owner
                    </p>

                    <p class="text-xs text-indigo-600 mt-1">
                        El usuario tendrá el rol de propietario del negocio seleccionado.
                    </p>
                </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-100">

                <button
                    type="button"
                    onclick="closeUserModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition"
                >
                    Cancelar
                </button>

                <button
                    type="submit"
                    id="userSubmitButton"
                    class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition"
                >
                    Guardar usuario
                </button>

            </div>
        </form>
    </div>
</div>