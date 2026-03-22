<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tenant->name }}</title>

    @vite(['resources/css/app.css'])
    
    <style>
        /* Estilos para los modales */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            background: white;
            border-radius: 1.5rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: white;
            border: none;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.2s;
            z-index: 10;
        }
        
        .modal-close:hover {
            transform: scale(1.1);
            background: #f3f4f6;
        }
        
        .modal-close svg {
            width: 1.25rem;
            height: 1.25rem;
        }
        
        .category-section {
            margin-bottom: 2rem;
            scroll-margin-top: 1rem;
        }
        
        .category-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
            position: sticky;
            top: 0;
            background: #f3f4f6;
            z-index: 5;
            padding-top: 0.5rem;
        }
        
        .category-title span {
            background: #ef4444;
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            margin-left: 0.75rem;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="min-h-screen bg-gray-100">

    <div class="max-w-6xl mx-auto">

        {{-- 🖼 COVER CONTROLADO --}}
        <div class="relative">
            <div class="h-40 md:h-52 lg:h-60 overflow-hidden">
                <img src="{{asset('storage/'.$tenant->logo_path) }}"
                     class="w-full h-full object-cover">
            </div>

            {{-- INFO CARD MEJORADA --}}
            <div class="px-4 md:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-4 -mt-10 relative z-10 bg-gradient-to-r from-red-50 to-red-300">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 flex-1">
                            <div>
                                <h1 class="text-xl md:text-2xl font-bold text-slate-950">
                                    {{ $tenant->name }}
                                </h1>
                                <p class="text-green-600 text-sm flex items-center gap-1 mt-1">
                                    <span class="w-2 h-2 bg-green-600 rounded-full animate-pulse"></span>
                                    Ver Menú en línea
                                </p>
                            </div>
                        </div>
                        
                        {{-- BOTÓN MÁS INFORMACIÓN MEJORADO --}}
                        <button onclick="openInfoModal()" 
                                class="flex items-center gap-2 bg-gray-100 hover:bg-red-50 px-4 py-2 rounded-full transition-all duration-200 group">
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-red-600">Más información</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL DE INFORMACIÓN DEL RESTAURANTE --}}
        <div id="infoModal" class="modal-overlay" onclick="if(event.target === this) closeInfoModal()">
            <div class="modal-content">
                <div class="relative p-6">
                    <button onclick="closeInfoModal()" class="modal-close">
                        <svg class="text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 mx-auto rounded-2xl overflow-hidden border-4 border-red-100 shadow-lg mb-3">
                            @if($tenant->logo_path)
                                <img src="{{ asset('storage/'.$tenant->logo_path) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $tenant->name }}</h2>
                    </div>
                    
                    @if($tenant->description)
                        <div class="mb-4">
                            <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                Descripción
                            </h3>
                            <p class="text-gray-600">{{ $tenant->description }}</p>
                        </div>
                    @endif
                    
                    @if($tenant->address)
                        <div class="mb-4">
                            <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Dirección
                            </h3>
                            <p class="text-gray-600">{{ $tenant->address }}</p>
                        </div>
                    @endif
                    
                    {{-- Redes sociales si existen --}}
                    <div class="flex justify-center gap-3 mt-6">
                        @if($tenant->instagram)
                            <a href="{{ $tenant->instagram }}" target="_blank" class="p-3 bg-gradient-to-br from-purple-500 to-pink-500 text-white rounded-xl hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/></svg>
                            </a>
                        @endif
                        @if($tenant->facebook)
                            <a href="{{ $tenant->facebook }}" target="_blank" class="p-3 bg-blue-600 text-white rounded-xl hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL DE PRODUCTO (SOLO VISUALIZACIÓN) --}}
        <div id="productModal" class="modal-overlay" onclick="if(event.target === this) closeProductModal()">
            <div class="modal-content">
                <div class="relative">
                    <button onclick="closeProductModal()" class="modal-close">
                        <svg class="text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    
                    <div id="modalProductImage" class="w-full h-64 bg-gray-200 rounded-t-2xl overflow-hidden">
                        <img src="" alt="" class="w-full h-full object-cover" id="modalProductImg">
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 id="modalProductName" class="text-2xl font-bold text-gray-800"></h3>
                            <span id="modalProductPrice" class="text-2xl font-bold text-red-600"></span>
                        </div>
                        
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Descripción</h4>
                            <p id="modalProductDescription" class="text-gray-600 leading-relaxed"></p>
                        </div>
                        
                        {{-- Botón de cerrar más pequeño y centrado --}}
                        <div class="flex justify-center">
                            <button onclick="closeProductModal()" 
                                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                                Cerrar
                            </button>
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

        {{-- 📦 PRODUCTOS CON CATEGORÍAS AGRUPADAS --}}
        <div class="px-4 md:px-8 mt-8 pb-16">

            <div id="productsContainer">
                @foreach($categories as $category)
                    @if($category->products->count() > 0)
                        <div class="category-section" data-category-id="{{ $category->id }}">
                            <h2 class="category-title">
                                {{ $category->name }}
                                <span>{{ $category->products->count() }} productos</span>
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($category->products as $product)
                                    <div class="product-card bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition"
                                         data-category="{{ $category->id }}"
                                         data-name="{{ strtolower($product->name) }}"
                                         data-category-name="{{ strtolower($category->name) }}"
                                         data-product-id="{{ $product->id }}">

                                        <div class="flex gap-4">
                                            {{-- IMAGEN --}}
                                            <div class="w-20 h-20 md:w-24 md:h-24 rounded-lg overflow-hidden flex-shrink-0 bg-gray-200 cursor-pointer"
                                                onclick="openProductModal({{ $product->id }})">

                                                <img src="{{ $product->image_path ? asset('storage/'.$product->image_path) : asset('storage/default.jpg') }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">

                                            </div>

                                            {{-- INFO --}}
                                            <div class="flex-1 flex flex-col justify-between">
                                                <div class="cursor-pointer" onclick="openProductModal({{ $product->id }})">
                                                    <h3 class="font-semibold text-sm md:text-base hover:text-red-600 transition">
                                                        {{ $product->name }}
                                                    </h3>
                                                    <p class="text-xs md:text-sm text-gray-500 mt-1 line-clamp-2">
                                                        {{ $product->description }}
                                                    </p>
                                                </div>

                                                <div class="flex justify-between items-center mt-2">
                                                    <span class="text-red-600 font-bold text-sm md:text-base">
                                                        {{ number_format($product->price) }}$
                                                    </span>

                                                    <button onclick="openProductModal({{ $product->id }})"
                                                            class="bg-red-600 text-white w-8 h-8 rounded-lg flex items-center justify-center font-bold hover:bg-red-700 hover:scale-110 transition-all">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</div>

<script>

// En menu.blade.php, modifica la función trackEvent para hacer un debug:

function trackEvent(eventType, entityType = null, entityId = null) {
    
    // DEBUG: Mostrar en consola lo que se está enviando
    console.log('🔍 Enviando evento:', {
        event_type: eventType,
        entity_type: entityType,
        entity_id: entityId
    });

    fetch("{{ route('analytics.track') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            event_type: eventType,
            entity_type: entityType,
            entity_id: entityId
        })
    })
    .then(response => response.json())
    .then(data => console.log('✅ Respuesta:', data))
    .catch(error => console.error('❌ Error:', error));
}

// ==================== CONFIGURACIÓN DE PRODUCTOS ====================
const productsData = {
    @foreach($categories as $category)
        @foreach($category->products as $product)
            {{ $product->id }}: {
                id: {{ $product->id }},
                name: "{{ $product->name }}",
                description: "{{ addslashes($product->description) }}",
                price: "{{ number_format($product->price,) }}$",
                price_raw: {{ $product->price }},
                image: "{{ $product->image_path ? asset('storage/'.$product->image_path) : '' }}",
                category: "{{ $category->name }}",
                is_available: {{ $product->is_available ? 'true' : 'false' }}
            },
        @endforeach
    @endforeach
};

// ==================== VARIABLES GLOBALES ====================
let currentCategory = "all";

// ==================== FUNCIONES DEL MODAL DE INFORMACIÓN ====================
function openInfoModal() {
    document.getElementById('infoModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeInfoModal() {
    document.getElementById('infoModal').style.display = 'none';
    document.body.style.overflow = '';
}

// ==================== FUNCIONES DEL MODAL DE PRODUCTO (SOLO VISUALIZACIÓN) ====================
function openProductModal(productId) {

      // Asegurar que productId es un número entero
    productId = parseInt(productId);
    
    console.log('📦 Abriendo producto ID:', productId, 'Tipo:', typeof productId);
    
    // Enviar track
    trackEvent('product_view', 'product', productId);

    const product = productsData[productId];
    if (!product) return;
    
    document.getElementById('modalProductName').textContent = product.name;
    document.getElementById('modalProductDescription').textContent = product.description || 'Sin descripción disponible';
    document.getElementById('modalProductPrice').textContent = product.price;
    document.getElementById('modalProductImg').src = product.image || 'https://via.placeholder.com/400x300?text=Sin+imagen';
    document.getElementById('modalProductImg').alt = product.name;
    
    document.getElementById('productModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeProductModal() {
    document.getElementById('productModal').style.display = 'none';
    document.body.style.overflow = '';
}

// ==================== FUNCIONES DE FILTRO ====================
function filterCategory(categoryId) {
    currentCategory = categoryId;

    if (categoryId !== 'all') {
        // Asegurar que categoryId es número
        categoryId = parseInt(categoryId);
        console.log('📁 Categoría seleccionada ID:', categoryId, 'Tipo:', typeof categoryId);
        
        trackEvent('category_view', 'category', categoryId);
    }

    let categorySections = document.querySelectorAll('.category-section');
    let buttons = document.querySelectorAll('.category-btn');

    buttons.forEach(btn => {
        btn.classList.remove('bg-red-600', 'text-white');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });

    document.querySelectorAll(`[data-category="${categoryId}"]`).forEach(btn => {
        btn.classList.remove('bg-gray-200', 'text-gray-700');
        btn.classList.add('bg-red-600', 'text-white');
    });

    applyFilters();
}

document.getElementById('searchInput').addEventListener('keyup', function() {

    let query = this.value;

    if (query.length >= 3) {
        trackEvent('search');
    }
    applyFilters();
});

function applyFilters() {
    let search = document.getElementById('searchInput').value.toLowerCase();
    let categorySections = document.querySelectorAll('.category-section');
    let products = document.querySelectorAll('.product-card');

    // Primero ocultar todos los productos
    products.forEach(product => {
        let matchesCategory = currentCategory === "all" || product.dataset.category === currentCategory;
        let matchesSearch = product.dataset.name.includes(search) || 
                           (product.dataset.categoryName && product.dataset.categoryName.includes(search));

        if (matchesCategory && matchesSearch) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }
    });

    // Mostrar/ocultar secciones de categorías según productos visibles
    categorySections.forEach(section => {
        let sectionProducts = section.querySelectorAll('.product-card');
        let hasVisibleProducts = Array.from(sectionProducts).some(p => p.style.display === "block");
        
        if (hasVisibleProducts && (currentCategory === "all" || section.dataset.categoryId === currentCategory)) {
            section.style.display = "block";
        } else {
            section.style.display = "none";
        }
    });
}

// ==================== CERRAR MODALES CON TECLA ESC ====================
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeInfoModal();
        closeProductModal();
    }
});

// ==================== INICIALIZACIÓN ====================
document.addEventListener('DOMContentLoaded', function() {
    // Asegurar que los modales estén ocultos al inicio
    closeInfoModal();
    closeProductModal();
});
</script>

</body>
</html>