<div id="tenantModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative animate-fadeIn">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h2 id="tenantModalTitle" class="text-xl font-semibold text-gray-800">
                Nuevo Tenant
            </h2>

            <button onclick="closeTenantModal()"
                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none">
                &times;
            </button>
        </div>

        {{-- Form --}}
        <form id="tenantForm" method="POST">
            @csrf

            <div id="tenantMethodField"></div>

            {{-- Nombre --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre del negocio
                </label>

                <input
                    type="text"
                    name="name"
                    id="tenantName"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Ej: Panadería Don José"
                    required
                >
            </div>


            {{-- Plan --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Plan
                </label>

                <select
                    name="plan_id"
                    id="tenantPlan"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
                    <option value="">
                        Seleccionar plan
                    </option>

                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}">
                            {{ $plan->name }} (${{ number_format($plan->price, 2) }})
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Estado
                </label>

                <select
                    name="status"
                    id="tenantStatus"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >

                    <option value="active">
                        Activo
                    </option>

                    <option value="trial">
                        Trial
                    </option>

                    <option value="suspended">
                        Suspendido
                    </option>

                    <option value="expired">
                        Expirado
                    </option>

                </select>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeTenantModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>