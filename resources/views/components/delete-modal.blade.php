<div id="globalDeleteModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6 relative">

        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            Eliminar
        </h2>

        <p class="text-sm text-gray-600 mb-6">
            ¿Estás seguro que deseas eliminar 
            <span id="globalDeleteName" class="font-semibold"></span>?
        </p>

        <form id="globalDeleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                    Cancelar
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                    Eliminar
                </button>
            </div>
        </form>

    </div>
</div>