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

            </div>

        </div>

    </div>

</div>