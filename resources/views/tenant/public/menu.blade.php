<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $tenant->name }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>

        @keyframes scaleIn{

        from{
        opacity:0;
        transform:scale(.9);
        }

        to{
        opacity:1;
        transform:scale(1);
        }

        }

        .animate-scaleIn{
        animation:scaleIn .25s ease;
        }

        /* Estilos base de los botones de categoría */
        .category-btn {
            background-color: #1e1e1e;
            color: white;
            border: 1px solid rgba(184, 134, 11, 0.4);
            padding: 0.625rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Efecto hover para desktop */
        @media (hover: hover) {
            .category-btn:hover {
                background-color: #b8860b;
                color: black;
                border-color: #b8860b;
                box-shadow: 0 8px 20px rgba(184, 134, 11, 0.3);
            }
        }

        /* Efecto active (touch) para mobile */
        .category-btn:active {
            transform: scale(0.96);
            background-color: #b8860b;
            color: black;
            border-color: #b8860b;
            transition: all 0.1s ease;
        }

        /* Estilo para botón activo/seleccionado */
        .category-btn.active {
            background-color: #b8860b;
            color: black;
            border-color: #b8860b;
            box-shadow: 0 8px 20px rgba(184, 134, 11, 0.3);
        }

        </style>

    </head>

<body class="bg-[#0a0a0a] text-gray-200">

<div class="min-h-screen bg-linear-to-b from-[#0a0a0a] via-[#0a0a0a] to-[#050505]">

    <!-- Eliminado el max-w-6xl y mx-auto para que ocupe todo el ancho -->
    <div class="w-full">

            <header class="relative w-full">

                <!-- HERO IMAGEN CON ESQUINAS REDONDEADAS -->
                <div class="mx-4 md:mx-6 mt-4 md:mt-6">
                    <div class="h-56 md:h-72 lg:h-80 overflow-hidden rounded-2xl shadow-2xl relative">
                        
                        <img src="{{ asset('storage/'.$tenant->logo_path) }}"
                            class="w-full h-full object-cover object-center transform hover:scale-105 transition-transform duration-700">
                        
                        <!-- Overlay degradado elegante -->
                        <div class="absolute inset-0 bg-linear-to-t from-[#0a0a0a] via-[#0a0a0a]/40 to-transparent rounded-2xl"></div>
                        
                        <!-- Borde decorativo inferior -->
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-linear-to-r from-[#b8860b] via-[#d4a017] to-[#b8860b] rounded-b-2xl"></div>
                        
                    </div>
                </div>

                <div class="px-4 md:px-6 -mt-8 relative z-10">

                    <div class="bg-linear-to-br from-[#1a1a1a] to-[#141414] rounded-2xl shadow-2xl p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border border-[#b8860b]/20 backdrop-blur-sm">

                        <div class="flex-1">

                            <h1 class="text-2xl md:text-3xl font-bold bg-linear-to-r from-white to-gray-300 bg-clip-text text-transparent">
                                {{ $tenant->name }}
                            </h1>

                            <p class="text-[#d4a017] text-sm font-medium flex items-center gap-1.5 mt-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>

                                <span>Menú online</span>
                                <span class="w-1 h-1 bg-[#b8860b] rounded-full mx-1"></span>
                                <span class="text-gray-400 text-xs">Pedidos al instante</span>
                            </p>

                        </div>

                        <button onclick="openInfoModal()" 
                            class="bg-linear-to-r from-[#b8860b] to-[#d4a017] hover:from-[#d4a017] hover:to-[#e5a035] text-black font-semibold px-6 py-2.5 rounded-full text-sm transition-all duration-300 shadow-lg hover:shadow-xl flex items-center gap-2 border border-white/10">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>

                            Más información

                        </button>

                    </div>

                </div>

            </header>

            <div id="infoModal"
                style="display:none"
                onclick="closeInfoModal()"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">

                <div onclick="event.stopPropagation()"
                    class="bg-gray-900 text-white rounded-2xl w-[90%] max-w-md shadow-2xl animate-scaleIn overflow-hidden">

                    <div class="flex justify-between items-center border-b border-gray-800 p-4">

                        <h3 class="text-lg font-bold text-orange-400">
                            Información del negocio
                        </h3>

                        <button onclick="closeInfoModal()"
                                class="text-gray-400 hover:text-white text-xl">
                            ✕
                        </button>

                    </div>

                    <!-- CONTENIDO -->

                    <div class="p-6 space-y-5 text-center">

                        <!-- LOGO -->

                        @if($tenant->logo_path)

                            <img
                                src="{{ asset('storage/'.$tenant->logo_path) }}"
                                alt="Logo"
                                class="w-24 h-24 object-contain mx-auto rounded-xl bg-gray-800 p-2">

                        @endif


                        <!-- DESCRIPCIÓN -->

                        @if($tenant->description)

                            <p class="text-gray-300 text-sm">
                                {{ $tenant->description }}
                            </p>

                        @endif


                        <!-- DIRECCIÓN -->

                        @if($tenant->address)

                            <div class="flex items-center justify-center gap-2 text-gray-400 text-sm">

                                <span>📍</span>

                                <span>{{ $tenant->address }}</span>

                            </div>

                        @endif


                        <!-- REDES SOCIALES -->

                       <div class="flex justify-center gap-6 pt-2">

                            @if($tenant->instagram)
                                <a href="{{ $tenant->instagram }}"
                                target="_blank"
                                class="bg-gray-800 p-3 rounded-xl hover:bg-gray-700 transition">
                                    <!-- Instagram SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-pink-500"
                                        fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M7.75 2C4.57 2 2 4.57 2 7.75v8.5C2 19.43 4.57 22 7.75 22h8.5C19.43 22 22 19.43 22 16.25v-8.5C22 4.57 19.43 2 16.25 2h-8.5zm0 2h8.5A3.75 3.75 0 0 1 20 7.75v8.5A3.75 3.75 0 0 1 16.25 20h-8.5A3.75 3.75 0 0 1 4 16.25v-8.5A3.75 3.75 0 0 1 7.75 4zm9.25 1.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5zM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
                                    </svg>
                                </a>
                            @endif

                            @if($tenant->facebook)
                                <a href="{{ $tenant->facebook }}"
                                target="_blank"
                                class="bg-gray-800 p-3 rounded-xl hover:bg-gray-700 transition">
                                    <!-- Facebook SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-blue-500"
                                        fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M22 12a10 10 0 1 0-11.56 9.87v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.24.19 2.24.19v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.88h-2.34v6.99A10 10 0 0 0 22 12z"/>
                                    </svg>
                                </a>
                            @endif

                            @if($tenant->whatsapp_number)
                                @php
                                    // Limpiar el número: eliminar espacios, +, -, paréntesis y cualquier cosa que no sea número
                                    $whatsappNumber = preg_replace('/[^0-9]/', '', $tenant->whatsapp_number);
                                    
                                    // Construir URL base
                                    $whatsappUrl = 'https://wa.me/' . $whatsappNumber;
                                    
                                    // Si hay mensaje personalizado en la BD, usarlo; si no, mensaje por defecto
                                    if (!empty($tenant->whatsapp_message)) {
                                        $whatsappUrl .= '?text=' . urlencode($tenant->whatsapp_message);
                                    } else {
                                        // Mensaje por defecto (opcional)
                                        $mensajeDefecto = "Hola! Vengo del catálogo digital de " . $tenant->name . ". Me gustaría hacer una consulta.";
                                        $whatsappUrl .= '?text=' . urlencode($mensajeDefecto);
                                    }
                                @endphp
                                
                                <a href="{{ $whatsappUrl }}"
                                target="_blank"
                                class="bg-gray-800 p-3 rounded-xl hover:bg-gray-700 transition">
                                    <!-- WhatsApp SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-green-500"
                                        fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.33 4.95L2.05 22l5.32-1.4c1.45.79 3.08 1.21 4.77 1.21 5.46 0 9.91-4.45 9.91-9.91 0-5.46-4.45-9.9-9.91-9.9zM12.04 20.15c-1.49 0-2.95-.4-4.22-1.15l-.3-.18-3.16.83.84-3.08-.2-.31a8.245 8.245 0 0 1-1.26-4.4c0-4.56 3.71-8.27 8.27-8.27s8.27 3.71 8.27 8.27-3.71 8.27-8.27 8.27z"/>
                                        <path d="M17.34 14.38c-.29-.15-1.72-.85-1.99-.95-.27-.1-.46-.15-.66.15-.2.3-.76.95-.93 1.14-.17.2-.34.22-.63.07-.29-.15-1.23-.45-2.34-1.44-.86-.77-1.44-1.72-1.61-2.01-.17-.29-.02-.45.13-.59.13-.13.29-.34.44-.51.15-.17.2-.29.3-.49.1-.2.05-.37-.02-.52-.07-.15-.66-1.59-.91-2.18-.24-.58-.48-.5-.66-.51-.17-.01-.37-.01-.57-.01-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.06 2.87 1.21 3.07.15.2 2.09 3.19 5.06 4.47.71.31 1.26.49 1.69.63.71.23 1.35.19 1.86.12.57-.09 1.72-.7 1.96-1.38.24-.68.24-1.26.17-1.38-.07-.12-.26-.2-.55-.35z"/>
                                    </svg>
                                </a>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        <!-- ===================================================== -->
        <!-- MODAL DE PRODUCTO                                     -->
        <!-- Se abre cuando el usuario hace click en un producto   -->
        <!-- ===================================================== -->

            <div id="productModal"
                style="display:none"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">

                <!-- ================================================= -->
                <!-- CONTENEDOR DEL MODAL                              -->
                <!-- ================================================= -->

                <div class="bg-gray-900 text-white rounded-2xl w-[90%] max-w-md overflow-hidden shadow-2xl animate-scaleIn">

                    <!-- ================================================= -->
                    <!-- IMAGEN DEL PRODUCTO                               -->
                    <!-- Se completa dinámicamente con JS                  -->
                    <!-- ================================================= -->

                    <img id="modalProductImg"
                        class="w-full h-56 object-contain bg-gray-800">

                    <!-- ================================================= -->
                    <!-- CONTENIDO DEL PRODUCTO                            -->
                    <!-- ================================================= -->

                    <div class="p-6">

                        <!-- NOMBRE DEL PRODUCTO -->
                        <h3 id="modalProductName"
                            class="text-xl font-bold text-orange-400">
                        </h3>

                        <!-- DESCRIPCIÓN -->
                        <p id="modalProductDescription"
                        class="text-gray-300 mt-2 text-sm">
                        </p>

                        <!-- PRECIO -->
                        <p id="modalProductPrice"
                        class="text-2xl font-bold text-orange-400 mt-4">
                        </p>

                        <!-- ================================================= -->
                        <!-- BOTONES DE ACCIÓN                                 -->
                        <!-- ================================================= -->

                        <div class="flex gap-3 mt-6">

                            @if($tenant->hasFeature('cart'))

                                <!-- BOTÓN AGREGAR AL CARRITO -->
                                <button onclick="addToCart()"
                                        class="flex-1 bg-linear-to-r from-orange-500 to-rose-600 text-white py-3 rounded-xl font-semibold hover:scale-[1.02] transition">

                                    Agregar al carrito

                                </button>

                                <!-- BOTÓN CERRAR MODAL -->
                                <button onclick="closeProductModal()"
                                        class="w-12 bg-gray-800 rounded-xl hover:bg-gray-700 transition">

                                    ✕

                                </button>

                            @else

                                <!-- BOTÓN CERRAR (CUANDO NO HAY CARRITO) -->
                                <button onclick="closeProductModal()"
                                        class="flex-1 bg-gray-800 py-3 rounded-xl hover:bg-gray-700 transition">

                                    Cerrar

                                </button>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- BUSCADOR DE PRODUCTOS                                 -->
            <!-- Permite filtrar productos por nombre en tiempo real   -->
            <!-- ===================================================== -->

            <div class="px-4 md:px-6 mt-6">

                <div class="relative">

                    <!-- ================================================= -->
                    <!-- ICONO DE BÚSQUEDA (LADO IZQUIERDO DEL INPUT)      -->
                    <!-- ================================================= -->

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                        <svg class="w-5 h-5 text-[#b8860b]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                            </path>

                        </svg>

                    </div>


                    <!-- ================================================= -->
                    <!-- INPUT DE BÚSQUEDA                                 -->
                    <!-- ================================================= -->

                    <input
                        id="searchInput"
                        type="text"
                        placeholder="Buscar producto..."
                        class="w-full bg-[#1e1e1e] border border-[#b8860b]/40 focus:border-[#b8860b] rounded-full pl-12 pr-12 py-3.5 text-sm text-white placeholder:text-gray-200 focus:outline-none focus:ring-2 focus:ring-[#b8860b]/30 transition-all duration-300"
                    >


                    <!-- ================================================= -->
                    <!-- BOTÓN LIMPIAR BÚSQUEDA                            -->
                    <!-- Aparece cuando el usuario escribe texto           -->
                    <!-- ================================================= -->

                    <button id="clearSearch"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 opacity-0 invisible transition-all duration-200 hover:scale-110">

                        <svg class="w-5 h-5 text-gray-400 hover:text-[#b8860b]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>

                        </svg>

                    </button>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- FILTRO DE CATEGORÍAS                                  -->
            <!-- Permite filtrar los productos por categoría           -->
            <!-- Scroll horizontal para muchas categorías              -->
            <!-- ===================================================== -->

            <div class="px-4 md:px-6 mt-6 overflow-x-auto">

                <!-- ================================================= -->
                <!-- CONTENEDOR DE BOTONES DE CATEGORÍA                -->
                <!-- w-max permite que el contenido crezca horizontal  -->
                <!-- ================================================= -->

                <div class="flex gap-3 w-max">

                    <!-- ================================================= -->
                    <!-- BOTÓN: MOSTRAR TODOS LOS PRODUCTOS                -->
                    <!-- ================================================= -->

                    <button onclick="filterCategory('all')"
                            class="category-btn bg-[#1e1e1e] hover:bg-[#b8860b] active:bg-[#b8860b] text-white hover:text-black active:text-black px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300 border border-[#b8860b]/40 hover:border-[#b8860b] active:border-[#b8860b] shadow-md hover:shadow-lg active:shadow-lg"
                            data-category="all">

                        Todos

                    </button>


                    <!-- ================================================= -->
                    <!-- CATEGORÍAS DINÁMICAS DEL NEGOCIO                 -->
                    <!-- Se recorren desde la base de datos               -->
                    <!-- ================================================= -->

                    @foreach($categories as $category)

                        <button onclick="filterCategory('{{ $category->id }}')"
                                class="category-btn bg-[#1e1e1e] hover:bg-[#b8860b] active:bg-[#b8860b] text-white hover:text-black active:text-black px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300 border border-[#b8860b]/40 hover:border-[#b8860b] active:border-[#b8860b] shadow-md hover:shadow-lg active:shadow-lg"
                                data-category="{{ $category->id }}">

                            {{ $category->name }}

                        </button>

                    @endforeach

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- LISTADO DE PRODUCTOS                                  -->
            <!-- Se muestran agrupados por categorías                  -->
            <!-- ===================================================== -->

            <div class="mt-8 pb-20 px-4 md:px-6">

                <!-- CONTENEDOR GENERAL DE PRODUCTOS -->
                <div id="productsContainer">

                    @foreach($categories as $category)

                        <!-- SOLO MOSTRAR CATEGORÍA SI TIENE PRODUCTOS -->
                        @if($category->products->count())

                            <!-- ================================================= -->
                            <!-- SECCIÓN DE CATEGORÍA                              -->
                            <!-- ================================================= -->

                            <div class="category-section mb-10"
                                data-category-id="{{ $category->id }}">

                                <!-- TÍTULO DE LA CATEGORÍA -->
                                <h2 class="font-bold text-xl mb-5 text-gray-200 border-l-4 border-[#b8860b] pl-3">
                                    {{ $category->name }}
                                </h2>


                                <!-- ================================================= -->
                                <!-- GRID DE PRODUCTOS                                 -->
                                <!-- ================================================= -->

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">

                                    @foreach($category->products as $product)

                                        <!-- ================================================= -->
                                        <!-- TARJETA DE PRODUCTO                               -->
                                        <!-- ================================================= -->

                                        <div class="product-card bg-[#1e1e1e] rounded-xl overflow-hidden flex items-center transition-all duration-300 hover:scale-[1.02] shadow-[0_8px_30px_rgb(0,0,0,0.5)] hover:shadow-[0_15px_35px_rgba(184,134,11,0.2)] border border-[#b8860b]/60"
                                            data-category="{{ $category->id }}"
                                            data-name="{{ strtolower($product->name) }}">

                                            <!-- ================================================= -->
                                            <!-- IMAGEN DEL PRODUCTO                               -->
                                            <!-- ================================================= -->

                                            <div class="w-28 shrink-0 cursor-pointer relative overflow-hidden"
                                                onclick="openProductModal({{ $product->id }})">

                                                <img
                                                    src="{{ $product->image_path ? asset('storage/'.$product->image_path) : asset('storage/default.jpg') }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">

                                                <!-- Overlay decorativo -->
                                                <div class="absolute inset-0 bg-linear-to-r from-[#b8860b]/0 via-[#b8860b]/0 to-[#b8860b]/10"></div>

                                            </div>


                                            <!-- ================================================= -->
                                            <!-- CONTENIDO DEL PRODUCTO                           -->
                                            <!-- ================================================= -->

                                            <div class="flex-1 px-4 py-3 flex flex-col justify-center">

                                                <!-- NOMBRE -->
                                                <h3 class="font-semibold text-gray-100 text-base">
                                                    {{ $product->name }}
                                                </h3>

                                                <!-- DESCRIPCIÓN -->
                                                <p class="text-sm text-gray-400 mt-1 line-clamp-2">
                                                    {{ $product->description }}
                                                </p>

                                                <!-- PRECIO -->
                                                <p class="text-[#e5a035] font-bold mt-2 text-lg">
                                                    ${{ number_format($product->price) }}
                                                </p>

                                            </div>


                                            <!-- ================================================= -->
                                            <!-- BOTÓN DE ACCIÓN (+)                               -->
                                            <!-- Abre el modal del producto                        -->
                                            <!-- ================================================= -->

                                            <div class="flex items-center pr-4">

                                                <button onclick="openProductModal({{ $product->id }})"
                                                        class="bg-linear-to-r from-[#b8860b] to-[#d4a017] hover:from-[#d4a017] hover:to-[#e5a035] text-black font-bold w-10 h-10 rounded-full flex items-center justify-center text-xl transition-all duration-300 shadow-lg hover:shadow-xl shadow-[#b8860b]/30">

                                                    +

                                                </button>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        @endif

                    @endforeach

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- CARRITO DE COMPRAS                                   -->
            <!-- Solo aparece si el negocio tiene habilitada la       -->
            <!-- feature "cart"                                       -->
            <!-- ===================================================== -->

            @if($tenant->hasFeature('cart'))

                <!-- ================================================= -->
                <!-- BOTÓN FLOTANTE DEL CARRITO                        -->
                <!-- Aparece en la esquina inferior derecha            -->
                <!-- ================================================= -->

                <div onclick="openCart()"
                    class="fixed bottom-6 right-6 bg-linear-to-r from-orange-600 to-rose-700 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl cursor-pointer z-50 hover:scale-105 transition">

                    🛒

                    <!-- CONTADOR DE PRODUCTOS EN EL CARRITO -->
                    <span id="cartCount"
                        class="absolute -top-1 -right-1 bg-white text-rose-700 text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full shadow">

                        0

                    </span>

                </div>


                <!-- ================================================= -->
                <!-- MODAL DEL CARRITO                                 -->
                <!-- Se abre cuando el usuario presiona el botón       -->
                <!-- ================================================= -->

                <div id="cartModal"
                    style="display:none"
                    class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-end justify-center z-50">

                    <!-- CONTENEDOR DEL MODAL -->
                    <div class="bg-gray-900 text-white w-full max-w-md rounded-t-3xl shadow-2xl p-6 animate-slideUp">


                        <!-- ================================================= -->
                        <!-- HEADER DEL CARRITO                                -->
                        <!-- ================================================= -->

                        <div class="flex justify-between items-center mb-5">

                            <h3 class="text-xl font-bold text-orange-400">
                                Tu pedido
                            </h3>

                            <!-- BOTÓN CERRAR -->
                            <button onclick="closeCart()"
                                    class="w-9 h-9 rounded-full bg-gray-800 hover:bg-gray-700 flex items-center justify-center transition">

                                ✕

                            </button>

                        </div>


                        <!-- ================================================= -->
                        <!-- LISTADO DE PRODUCTOS DEL CARRITO                  -->
                        <!-- Se rellena dinámicamente con JavaScript           -->
                        <!-- ================================================= -->

                        <div id="cartItems" class="space-y-4"></div>


                        <!-- ================================================= -->
                        <!-- TOTAL DEL PEDIDO                                  -->
                        <!-- ================================================= -->

                        <div class="flex justify-between mt-6 border-t border-gray-700 pt-4">

                            <span class="text-gray-300 font-medium">
                                Total
                            </span>

                            <span id="cartTotal"
                                class="font-bold text-xl text-orange-400">

                                $0

                            </span>

                        </div>


                        <!-- ================================================= -->
                        <!-- BOTONES DE ACCIÓN                                 -->
                        <!-- ================================================= -->

                        <div class="flex gap-3 mt-6">

                            <!-- BOTÓN VACIAR CARRITO -->
                            <button onclick="clearCart()"
                                    class="flex-1 bg-gray-800 py-3 rounded-xl text-gray-300 hover:bg-gray-700 transition">

                                Vaciar

                            </button>

                            <!-- BOTÓN ENVIAR PEDIDO POR WHATSAPP -->
                            <button onclick="sendOrder()"
                                    class="flex-1 bg-green-500 hover:bg-green-600 py-3 rounded-xl font-semibold text-white shadow-lg transition">

                                Enviar por WhatsApp

                            </button>

                        </div>

                    </div>

                </div>

            @endif

    </div>

</div>

<script>

// ==================== DATA ====================

const productsData = @json(
    $categories->flatMap->products->keyBy('id')
);

// ==================== VARIABLES ====================

let currentCategory = "all";


// ==================== MODAL INFO ====================

function openInfoModal() {

    const modal = document.getElementById("infoModal");

    if(!modal) return;

    modal.style.display = "flex";

    document.body.style.overflow = "hidden";
}

function closeInfoModal() {

    const modal = document.getElementById("infoModal");

    if(!modal) return;

    modal.style.display = "none";

    document.body.style.overflow = "";
}


// ==================== MODAL PRODUCTO ====================

let selectedProductId = null;

function openProductModal(productId) {

    const product = productsData[productId];

    if(!product) return;

    selectedProductId = productId;

    document.getElementById("modalProductName").textContent = product.name;

    document.getElementById("modalProductDescription").textContent =
        product.description || "Sin descripción disponible";

    document.getElementById("modalProductPrice").textContent =
        "$" + product.price;

    document.getElementById("modalProductImg").src =
        product.image_path
        ? "/storage/" + product.image_path
        : "/storage/default.jpg";

    document.getElementById("productModal").style.display = "flex";

    document.body.style.overflow = "hidden";
}

function closeProductModal() {

    document.getElementById("productModal").style.display = "none";

    document.body.style.overflow = "";
}

// Cerrar al hacer click fuera del modal //
document.getElementById("productModal").addEventListener("click", function(e){

    if(e.target.id === "productModal"){
        closeProductModal();
    }

});


// ==================== FILTRO CATEGORIA ====================

function filterCategory(categoryId) {

    currentCategory = categoryId;

    const buttons = document.querySelectorAll(".category-btn");

    // Remover clase active de todos los botones
    buttons.forEach(btn => {
        btn.classList.remove("active");
    });

    // Agregar clase active al botón clickeado
    const activeBtn = document.querySelector(`.category-btn[data-category="${categoryId}"]`);
    
    if(activeBtn){
        activeBtn.classList.add("active");
    }

    applyFilters();
}



// ==================== FILTROS ====================

function applyFilters(){

    const search = document
        .getElementById("searchInput")
        .value
        .toLowerCase()
        .trim();

    const products = document.querySelectorAll(".product-card");
    const sections = document.querySelectorAll(".category-section");

    // ====================
    // FILTRAR PRODUCTOS
    // ====================

    products.forEach(product => {

        const name = product.dataset.name;
        const category = product.dataset.category;

        const matchCategory =
            currentCategory === "all" || category === currentCategory;

        const matchSearch =
            name.includes(search);

        if(matchCategory && matchSearch){

            product.classList.remove("hidden");

        }else{

            product.classList.add("hidden");

        }

    });


    // ====================
    // OCULTAR CATEGORIAS VACIAS
    // ====================

    sections.forEach(section => {

        const visibleProducts = section.querySelectorAll(
            ".product-card:not(.hidden)"
        );

        if(visibleProducts.length > 0){

            section.classList.remove("hidden");

        }else{

            section.classList.add("hidden");

        }

    });

}


// ==================== ESC ====================

document.addEventListener("keydown", function(e){

    if(e.key === "Escape"){

        closeInfoModal();

        closeProductModal();

        closeCart();

    }

});


// ==================== INIT ====================

document.addEventListener("DOMContentLoaded", function(){

    closeInfoModal();

    closeProductModal();

    loadCart();

    const searchInput = document.getElementById("searchInput");

        if(searchInput){
            searchInput.addEventListener("keyup", applyFilters);
        }

});


// =======================================================
// 🛒 CARRITO
// =======================================================

let cart = JSON.parse(localStorage.getItem("cart")) || [];


// ==================== AGREGAR AL CARRITO ====================

function addToCart(){

    if(!selectedProductId) return;

    const product = productsData[selectedProductId];

    const img = document.getElementById("modalProductImg");

    flyToCart(img);

    const existing = cart.find(item => item.id === product.id);

    if(existing){

        existing.quantity++;

    }else{

        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1
        });

    }

    saveCart();

    updateCartUI();

    closeProductModal();
}

// Animación de vuelo al carrito //
function flyToCart(img){

    const cartIcon = document.querySelector('[onclick="openCart()"]');

    if(!img || !cartIcon) return;

    const flyingImg = img.cloneNode(true);

    const imgRect = img.getBoundingClientRect();
    const cartRect = cartIcon.getBoundingClientRect();

    flyingImg.style.position = "fixed";
    flyingImg.style.left = imgRect.left + "px";
    flyingImg.style.top = imgRect.top + "px";
    flyingImg.style.width = "120px";
    flyingImg.style.height = "120px";
    flyingImg.style.borderRadius = "12px";
    flyingImg.style.transition = "all .7s cubic-bezier(.65,-0.25,.25,1.25)";
    flyingImg.style.zIndex = "9999";
    flyingImg.style.pointerEvents = "none";

    document.body.appendChild(flyingImg);

    setTimeout(()=>{

        flyingImg.style.left = cartRect.left + "px";
        flyingImg.style.top = cartRect.top + "px";
        flyingImg.style.width = "20px";
        flyingImg.style.height = "20px";
        flyingImg.style.opacity = "0.5";

    },50);

    setTimeout(()=>{
        flyingImg.remove();
    },700);

}


// ==================== GUARDAR ====================

function saveCart(){

    localStorage.setItem("cart", JSON.stringify(cart));

}


// ==================== CARGAR ====================

function loadCart(){

    updateCartUI();


}


// ==================== UI ====================

function updateCartUI(){

    const cartItemsContainer = document.getElementById("cartItems");
    const cartCount = document.getElementById("cartCount");

    cartItemsContainer.innerHTML = "";

    let total = 0;
    let count = 0;

    cart.forEach(item => {

        total += item.price * item.quantity;
        count += item.quantity;

        cartItemsContainer.innerHTML += `
        
        <div class="flex justify-between items-center bg-gray-800 rounded-xl p-3">

            <div>
                <p class="text-white font-medium">${item.name}</p>
                <p class="text-gray-400 text-sm">$${item.price}</p>
            </div>

            <div class="flex items-center gap-3">

                <button 
                    onclick="decreaseQuantity(${item.id})"
                    class="w-8 h-8 bg-gray-700 rounded-lg text-white text-lg">
                    -
                </button>

                <span class="text-white font-semibold">
                    ${item.quantity}
                </span>

                <button 
                    onclick="increaseQuantity(${item.id})"
                    class="w-8 h-8 bg-amber-500 rounded-lg text-black text-lg">
                    +
                </button>

            </div>

        </div>
        `;
    });

    document.getElementById("cartTotal").innerText = "$" + total;

    if(cartCount){
        cartCount.innerText = count;
    }

}

// ==================== DISMINUIR CANTIDAD ====================
function increaseQuantity(productId){

    const item = cart.find(p => p.id === productId);

    if(!item) return;

    if(item.quantity >= 10) return;

    item.quantity++;

    saveCart();

    updateCartUI();
}

// ==================== AUMENTAR CANTIDAD ====================
function decreaseQuantity(productId){

    const item = cart.find(p => p.id === productId);

    if(!item) return;

    if(item.quantity <= 1) return;

    item.quantity--;

    saveCart();

    updateCartUI();
}


// Animación de rebote en el icono del carrito //
function cartIconBounce(){

    const cartIcon = document.querySelector('[onclick="openCart()"]');

    if(!cartIcon) return;

    cartIcon.animate([
        { transform: "scale(1)" },
        { transform: "scale(1.2)" },
        { transform: "scale(1)" }
    ],{
        duration:300
    });

}


// ==================== ELIMINAR ====================

function removeFromCart(index){

    cart.splice(index,1);

    saveCart();

    updateCartUI();

}


// ==================== VACIAR ====================

function clearCart(){

    cart = [];

    saveCart();

    updateCartUI();

}


// ==================== MODAL CARRITO ====================

function openCart(){

    document.getElementById("cartModal").style.display = "flex";

    document.body.style.overflow = "hidden";
}

function closeCart(){

    document.getElementById("cartModal").style.display = "none";

    document.body.style.overflow = "";
}


// ==================== ENVIAR WHATSAPP ====================

function sendOrder(){

    if(cart.length === 0) return;

    let message = "Hola! Quiero pedir:%0A";

    let total = 0;

    cart.forEach(item => {

        message += `• ${item.name} x${item.quantity}%0A`;

        total += item.price * item.quantity;

    });

    message += `%0ATotal: $${total}`;

    const phone = "{{ $tenant->whatsapp_number }}";

    const url = `https://wa.me/${phone}?text=${message}`;

    window.open(url,"_blank");
}

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


</body>
</html>