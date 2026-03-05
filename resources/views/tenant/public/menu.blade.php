<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tenant->name }}</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

<div class="min-h-screen bg-gray-100">

    {{-- 🔴 PROMO --}}
    <div class="bg-red-600 text-white px-4 py-3 flex justify-between items-center">
        <span class="font-semibold text-sm">🔥 50% descuento especial</span>
        <button class="bg-white text-red-600 text-xs font-semibold px-3 py-1 rounded-md">
            Ver
        </button>
    </div>

    <div class="max-w-6xl mx-auto">

        {{-- 🖼 COVER CONTROLADO --}}
        <div class="relative">
            <div class="h-40 md:h-52 lg:h-60 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5"
                     class="w-full h-full object-cover">
            </div>

            {{-- INFO CARD --}}
            <div class="px-4 md:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 -mt-10 relative z-10">

                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-xl overflow-hidden bg-gray-200">
                            <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092"
                                 class="w-full h-full object-cover">
                        </div>

                        <div>
                            <h1 class="text-lg md:text-2xl font-bold">
                                {{ $tenant->name }}
                            </h1>
                            <p class="text-green-600 text-sm mt-1">
                                ● Abierto ahora
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- 🔎 SEARCH --}}
        <div class="px-4 md:px-8 mt-6">
            <input id="searchInput"
                   type="text"
                   placeholder="Buscar producto..."
                   class="w-full bg-white border rounded-full px-4 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
        </div>

        {{-- 🏷 CATEGORIES --}}
        <div class="px-4 md:px-8 mt-6 overflow-x-auto">
            <div class="flex gap-3 w-max">

                <button onclick="filterCategory('all')"
                        class="category-btn bg-red-600 text-white px-4 py-2 rounded-full text-sm"
                        data-category="all">
                    Todos
                </button>

                @foreach($categories as $category)
                    <button onclick="filterCategory('{{ $category->id }}')"
                            class="category-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm"
                            data-category="{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach

            </div>
        </div>

        {{-- 📦 PRODUCTS --}}
        <div class="px-4 md:px-8 mt-8 pb-16">

            <div id="productsContainer"
                 class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                @foreach($categories as $category)
                    @foreach($category->products as $product)

                        <div class="product-card bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition"
                             data-category="{{ $category->id }}"
                             data-name="{{ strtolower($product->name) }}">

                            {{-- MOBILE HORIZONTAL / DESKTOP TAMBIÉN COMPACTO --}}
                            <div class="flex gap-4">

                                {{-- IMAGEN PEQUEÑA FIJA --}}
                                <div class="w-20 h-20 md:w-24 md:h-24 rounded-lg overflow-hidden flex-shrink-0 bg-gray-200">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/'.$product->image_path) }}"
                                             class="w-full h-full object-cover">
                                    @endif
                                </div>

                                {{-- INFO --}}
                                <div class="flex-1 flex flex-col justify-between">

                                    <div>
                                        <h3 class="font-semibold text-sm md:text-base">
                                            {{ $product->name }}
                                        </h3>

                                        <p class="text-xs md:text-sm text-gray-500 mt-1 line-clamp-2">
                                            {{ $product->description }}
                                        </p>
                                    </div>

                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-red-600 font-bold text-sm md:text-base">
                                            US$ {{ number_format($product->price, 2) }}
                                        </span>

                                        <button class="bg-red-600 text-white w-8 h-8 rounded-lg flex items-center justify-center font-bold hover:bg-red-700 transition">
                                            +
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach
                @endforeach

            </div>
        </div>

    </div>
</div>

{{-- 🔥 JS FILTRO MEJORADO --}}
<script>

let currentCategory = "all";

function filterCategory(categoryId) {

    currentCategory = categoryId;

    let products = document.querySelectorAll('.product-card');
    let buttons = document.querySelectorAll('.category-btn');

    buttons.forEach(btn => {
        btn.classList.remove('bg-red-600','text-white');
        btn.classList.add('bg-gray-200','text-gray-700');
    });

    document.querySelectorAll(`[data-category="${categoryId}"]`)
        .forEach(btn => {
            btn.classList.remove('bg-gray-200','text-gray-700');
            btn.classList.add('bg-red-600','text-white');
        });

    applyFilters();
}

document.getElementById('searchInput')
    .addEventListener('keyup', function() {
        applyFilters();
    });

function applyFilters() {

    let search = document.getElementById('searchInput').value.toLowerCase();
    let products = document.querySelectorAll('.product-card');

    products.forEach(product => {

        let matchesCategory = currentCategory === "all"
            || product.dataset.category === currentCategory;

        let matchesSearch = product.dataset.name.includes(search);

        if (matchesCategory && matchesSearch) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }

    });
}

</script>

</body>
</html>