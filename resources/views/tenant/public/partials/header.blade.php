<div class="relative w-full">

<!-- HERO IMAGEN CON ESQUINAS REDONDEADAS -->
<div class="mx-4 md:mx-6 mt-4 md:mt-6">
    <div class="h-56 md:h-72 lg:h-80 overflow-hidden rounded-2xl shadow-2xl relative">
        
        <img src="{{ asset('storage/'.$tenant->logo_path) }}"
        class="w-full h-full object-cover object-center transform hover:scale-105 transition-transform duration-700">
        
        <!-- Overlay degradado elegante -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/40 to-transparent rounded-2xl"></div>
        
        <!-- Borde decorativo inferior -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#b8860b] via-[#d4a017] to-[#b8860b] rounded-b-2xl"></div>
        
    </div>
</div>

<div class="px-4 md:px-6 -mt-8 relative z-10">

<div class="bg-gradient-to-br from-[#1a1a1a] to-[#141414] rounded-2xl shadow-2xl p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border border-[#b8860b]/20 backdrop-blur-sm">

<div class="flex-1">

<h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
{{ $tenant->name }}
</h1>

<p class="text-[#d4a017] text-sm font-medium flex items-center gap-1.5 mt-1.5">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
</svg>
<span>Menú online</span>
<span class="w-1 h-1 bg-[#b8860b] rounded-full mx-1"></span>
<span class="text-gray-400 text-xs">Pedidos al instante</span>
</p>

</div>

<button onclick="openInfoModal()" 
class="bg-gradient-to-r from-[#b8860b] to-[#d4a017] hover:from-[#d4a017] hover:to-[#e5a035] text-black font-semibold px-6 py-2.5 rounded-full text-sm transition-all duration-300 shadow-lg hover:shadow-xl flex items-center gap-2 border border-white/10">

<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
</svg>
Más información

</button>

</div>

</div>

</div>