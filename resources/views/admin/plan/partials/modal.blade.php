<div id="planModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <h2 id="planModalTitle" class="text-xl font-semibold text-gray-800">
                Nuevo Plan
            </h2>

            <button onclick="closePlanModal()"
                    class="text-gray-400 hover:text-gray-600 text-2xl">
                &times;
            </button>

        </div>

        {{-- Form --}}
        <form id="planForm" method="POST">

            @csrf

            <div id="planMethodField"></div>

            {{-- Nombre --}}
            <div class="mb-4">

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre del plan
                </label>

                <input
                    type="text"
                    name="name"
                    id="planName"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required>

            </div>

            {{-- Precio --}}
            <div class="mb-4">

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Precio mensual
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="price"
                    id="planPrice"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required>

            </div>

            {{-- Duración --}}
            <div class="mb-4">

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Duración (días)
                </label>

                <input
                    type="number"
                    name="duration_days"
                    id="planDuration"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    required>

            </div>

            {{-- Max products --}}
            <div class="mb-6">

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Máximo de productos
                </label>

                <input
                    type="number"
                    name="max_products"
                    id="planMaxProducts"
                    class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">

                <p class="text-xs text-gray-500 mt-1">
                    Dejar vacío para ilimitado
                </p>

            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closePlanModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>