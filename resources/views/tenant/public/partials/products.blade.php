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

                            <div class="product-card bg-[#1e1e1e] rounded-xl overflow-hidden flex items-stretch transition-all duration-300 hover:scale-[1.02] shadow-[0_8px_30px_rgb(0,0,0,0.5)] hover:shadow-[0_15px_35px_rgba(184,134,11,0.2)] border border-[#b8860b]/60"
                                 data-category="{{ $category->id }}"
                                 data-name="{{ strtolower($product->name) }}">

                                <!-- ================================================= -->
                                <!-- IMAGEN DEL PRODUCTO                               -->
                                <!-- ================================================= -->

                                <div class="w-28 flex-shrink-0 cursor-pointer relative overflow-hidden"
                                     onclick="openProductModal({{ $product->id }})">

                                    <img
                                        src="{{ $product->image_path ? asset('storage/'.$product->image_path) : asset('storage/default.jpg') }}"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">

                                    <!-- Overlay decorativo -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-[#b8860b]/0 via-[#b8860b]/0 to-[#b8860b]/10"></div>

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
                                            class="bg-gradient-to-r from-[#b8860b] to-[#d4a017] hover:from-[#d4a017] hover:to-[#e5a035] text-black font-bold w-10 h-10 rounded-full flex items-center justify-center text-xl transition-all duration-300 shadow-lg hover:shadow-xl shadow-[#b8860b]/30">

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