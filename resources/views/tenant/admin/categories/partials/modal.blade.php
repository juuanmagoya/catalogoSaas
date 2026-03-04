<div id="categoryModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative animate-fadeIn">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h2 id="modalTitle" class="text-xl font-semibold text-gray-800">
                Nueva Categoría
            </h2>

            <button onclick="closeCategoryModal()"
                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none">
                &times;
            </button>
        </div>

        {{-- Form --}}
        <form id="categoryForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="methodField"></div>

            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre
                </label>
                <input type="text"
                       name="name"
                       id="categoryName"
                       class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                       required>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Descripción
                </label>
                <textarea name="description"
                          id="categoryDescription"
                          rows="3"
                          class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            {{-- Estado --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Estado
                </label>

                <div class="flex items-center gap-3">
                    <!-- Valor por defecto -->
                    <input type="hidden" name="is_active" value="0">

                    <!-- Switch -->
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            id="categoryActive"
                            class="sr-only peer"
                        >

                        <div class="w-11 h-6 bg-gray-200 rounded-full
                            peer-checked:bg-indigo-600
                            peer-focus:ring-2 peer-focus:ring-indigo-300
                            transition-colors
                            relative
                            after:content-['']
                            after:absolute
                            after:top-[2px]
                            after:left-[2px]
                            after:bg-white
                            after:rounded-full
                            after:h-5
                            after:w-5
                            after:transition-all
                            peer-checked:after:translate-x-full">
                        </div>
                    </label>

                    <!--<span id="statusLabel" class="text-sm text-gray-600">
                        Inactiva
                    </span> -->
                </div>
            </div>

            {{-- Imagen --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Imagen
                </label>

                <input type="file"
                    name="image"
                    accept="image/*"
                    class="w-full text-sm text-gray-700">
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeCategoryModal()"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                    Cancelar
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                    Guardar
                </button>
            </div>
        </form>

    </div>
</div>