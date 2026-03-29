<!-- BOTON CARRITO FLOTANTE -->

<div
onclick="openCart()"
class="fixed bottom-6 right-6 bg-gradient-to-r from-orange-600 to-rose-700 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl cursor-pointer z-50 hover:scale-105 transition">

🛒

<span
id="cartCount"
class="absolute -top-1 -right-1 bg-white text-rose-700 text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full shadow">

0

</span>

</div>


<!-- MODAL CARRITO -->

<div
id="cartModal"
style="display:none"
class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-end justify-center z-50">

<div
class="bg-gray-900 text-white w-full max-w-md rounded-t-3xl shadow-2xl p-6 animate-slideUp">

<!-- HEADER -->

<div class="flex justify-between items-center mb-5">

<h3 class="text-xl font-bold text-orange-400">
Tu pedido
</h3>

<button
onclick="closeCart()"
class="w-9 h-9 rounded-full bg-gray-800 hover:bg-gray-700 flex items-center justify-center transition">

✕

</button>

</div>


<!-- ITEMS -->

<div id="cartItems" class="space-y-4"></div>


<!-- TOTAL -->

<div class="flex justify-between mt-6 border-t border-gray-700 pt-4">

<span class="text-gray-300 font-medium">
Total
</span>

<span
id="cartTotal"
class="font-bold text-xl text-orange-400">

$0

</span>

</div>


<!-- BOTONES -->

<div class="flex gap-3 mt-6">

<button
onclick="clearCart()"
class="flex-1 bg-gray-800 py-3 rounded-xl text-gray-300 hover:bg-gray-700 transition">

Vaciar

</button>

<button
onclick="sendOrder()"
class="flex-1 bg-green-500 hover:bg-green-600 py-3 rounded-xl font-semibold text-white shadow-lg transition">

Enviar por WhatsApp

</button>

</div>

</div>

</div>