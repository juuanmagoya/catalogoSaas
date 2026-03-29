<div class="px-4 md:px-6 mt-6">

<div class="relative">
    
    <!-- Icono de búsqueda -->
    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
        <svg class="w-5 h-5 text-[#b8860b]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
    
    <!-- Input de búsqueda -->
    <input id="searchInput"
        type="text"
        placeholder="Buscar producto..."
        class="w-full bg-[#1e1e1e] border border-[#b8860b]/40 focus:border-[#b8860b] rounded-full pl-12 pr-12 py-3.5 text-sm text-white placeholder:text-gray-200 focus:outline-none focus:ring-2 focus:ring-[#b8860b]/30 transition-all duration-300">
    
    <!-- Icono de limpiar (opcional - aparece cuando hay texto) -->
    <button id="clearSearch" 
        class="absolute inset-y-0 right-0 flex items-center pr-4 opacity-0 invisible transition-all duration-200 hover:scale-110">
        <svg class="w-5 h-5 text-gray-400 hover:text-[#b8860b]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    
</div>

</div>

<script>
    // Funcionalidad para mostrar/ocultar botón de limpiar
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    
    if (searchInput && clearButton) {
        searchInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                clearButton.classList.remove('opacity-0', 'invisible');
                clearButton.classList.add('opacity-100', 'visible');
            } else {
                clearButton.classList.remove('opacity-100', 'visible');
                clearButton.classList.add('opacity-0', 'invisible');
            }
        });
        
        clearButton.addEventListener('click', function() {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
            // Aquí puedes llamar a tu función de búsqueda
            if (typeof applyFilters === 'function') {
                applyFilters();
            }
        });
    }
</script>