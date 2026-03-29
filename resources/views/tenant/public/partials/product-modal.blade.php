<div id="productModal"
style="display:none"
class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">

<div class="bg-gray-900 text-white rounded-2xl w-[90%] max-w-md overflow-hidden shadow-2xl animate-scaleIn">

<!-- IMAGEN -->

<img
id="modalProductImg"
class="w-full h-56 object-contain bg-gray-800">

<!-- CONTENIDO -->

<div class="p-6">

<h3 id="modalProductName"
class="text-xl font-bold text-orange-400"></h3>

<p id="modalProductDescription"
class="text-gray-300 mt-2 text-sm"></p>

<p id="modalProductPrice"
class="text-2xl font-bold text-orange-400 mt-4"></p>

<div class="flex gap-3 mt-6">

@if($tenant->hasFeature('cart'))

<button
onclick="addToCart()"
class="flex-1 bg-gradient-to-r from-orange-500 to-rose-600 text-white py-3 rounded-xl font-semibold hover:scale-[1.02] transition">

Agregar al carrito

</button>

<button
onclick="closeProductModal()"
class="w-12 bg-gray-800 rounded-xl hover:bg-gray-700 transition">

✕

</button>

@else

<button
onclick="closeProductModal()"
class="flex-1 bg-gray-800 py-3 rounded-xl hover:bg-gray-700 transition">

Cerrar

</button>

@endif

</div>

</div>

</div>

</div>