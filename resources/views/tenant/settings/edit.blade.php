@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-10 px-6">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Configuración del negocio
        </h1>
        <p class="text-gray-500 mt-2">
            Aquí puedes editar la información pública de tu negocio.
            Estos datos pueden mostrarse en tu tienda, página web o enlaces
            de contacto para tus clientes.
        </p>
    </div>

    {{-- Mensaje éxito --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card configuración --}}
    <div class="bg-white shadow-xl rounded-2xl border border-gray-100 p-8">

        <form method="POST"
              action="{{ route('tenant.admin.settings.update', $tenant->slug) }}"
              enctype="multipart/form-data"
              class="space-y-8">

            @csrf
            @method('PUT')

            {{-- Logo --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Logo del negocio
                </label>

                <div class="flex items-center gap-6">
                    @if($tenant->logo_path)
                        <img
                            src="{{ Storage::url($tenant->logo_path) }}"
                            class="h-20 w-20 rounded-xl object-cover border"
                        >
                    @else
                        <div class="h-20 w-20 flex items-center justify-center rounded-xl bg-gray-100 text-gray-400 text-sm">
                            Sin logo
                        </div>
                    @endif

                    <input
                        type="file"
                        name="logo"
                        class="block w-full text-sm border border-gray-300 rounded-lg px-3 py-2
                        file:mr-4 file:py-2 file:px-4 file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100"
                    />
                </div>
            </div>

            {{-- Grid --}}
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Dirección
                    </label>
                    <input
                        type="text"
                        name="address"
                        value="{{ old('address', $tenant->address) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Número de WhatsApp
                    </label>
                    <input
                        type="text"
                        name="whatsapp_number"
                        value="{{ old('whatsapp_number', $tenant->whatsapp_number) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Instagram
                    </label>
                    <input
                        type="text"
                        name="instagram"
                        value="{{ old('instagram', $tenant->instagram) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Facebook
                    </label>
                    <input
                        type="text"
                        name="facebook"
                        value="{{ old('facebook', $tenant->facebook) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    />
                </div>
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Descripción / Horario
                </label>
                <textarea
                    name="description"
                    rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2"
                >{{ old('description', $tenant->description) }}</textarea>
            </div>

            {{-- Mensaje WhatsApp --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Mensaje automático de WhatsApp
                </label>
                <input
                    type="text"
                    name="whatsapp_message"
                    value="{{ old('whatsapp_message', $tenant->whatsapp_message) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2"
                />
            </div>

            <div class="pt-4 border-t flex justify-end">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition"
                >
                    Guardar cambios
                </button>
            </div>

        </form>

    </div>

    {{-- ===================== --}}
    {{-- SECCIÓN QR --}}
    {{-- ===================== --}}

    <div class="bg-white shadow-xl rounded-2xl border border-gray-100 p-8 mt-8">

        <h2 class="text-xl font-bold text-gray-800 mb-2">
            QR de tu catálogo
        </h2>

        <p class="text-gray-500 mb-6">
            Este QR permite que tus clientes accedan directamente a tu catálogo digital.
        </p>

        @php
            $catalogUrl = config('app.url') . '/' . $tenant->slug;
        @endphp

        {{-- URL catálogo --}}
        <div class="flex gap-3 mb-8">
            <input
                type="text"
                value="{{ $catalogUrl }}"
                readonly
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-gray-700"
            />
            <button
                onclick="navigator.clipboard.writeText('{{ $catalogUrl }}')"
                class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700"
            >
                Copiar
            </button>
        </div>

        {{-- BOTONES GENERAR --}}
        <div class="flex gap-4 mb-8 flex-wrap">

            {{-- QR Normal (SVG) --}}
            <a
                href="{{ route('tenant.admin.settings.qr', $tenant->slug) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow"
            >
                Generar QR normal
            </a>

            {{-- QR Premium con diseño completo 
            <a
                href="{{ route('tenant.admin.settings.qr.premium', $tenant->slug) }}"
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-lg shadow"
            >
                Generar QR Premium (con logo y diseño)
            </a> --}}

        </div>

        {{-- Mostrar QR Normal (SVG) --}}
        @if(!empty($qrCode))
            <div class="text-center">
                <div class="inline-block p-6 bg-gray-50 rounded-xl border">
                    <div id="qrSvgContainer">
                        {!! $qrCode !!}
                    </div>
                </div>

                {{-- Botones descarga QR Normal --}}
                <div class="flex flex-wrap justify-center gap-4 mt-6">
                    <a
                        href="{{ route('tenant.admin.settings.qr.download', $tenant->slug) }}"
                        class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg text-sm"
                    >
                        Descargar SVG
                    </a>

                    <button
                        onclick="downloadQR()"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm"
                    >
                        Descargar PNG
                    </button>

                    <a
                        href="{{ route('tenant.admin.settings.qr.poster', $tenant->slug) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm"
                    >
                        Cartel para imprimir
                    </a>
                </div>
            </div>
        @endif

    </div>

    {{-- ===================== --}}
    {{-- SECCIÓN QR PREMIUM (NUEVA) --}}
    {{-- ===================== 

    @if(isset($premiumQrBase64))
        <div class="bg-linear-to-br from-amber-50 to-orange-50 shadow-xl rounded-2xl border border-amber-200 p-8 mt-8">
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                ✨ Vista previa de tu QR Premium
            </h2>
            <p class="text-gray-600 mb-6">
                Este QR incluye el logo en el centro, texto personalizado y un diseño profesional.
                Ideal para imprimir en menús, carteles o tarjetas.
            </p>

            <div class="text-center">
                <div class="inline-block p-6 bg-white rounded-xl shadow-lg">
                    <img src="data:image/png;base64,{{ $premiumQrBase64 }}" 
                         alt="QR Premium" 
                         class="w-80 h-auto rounded-lg">
                </div>

                <a
                    href="{{ route('tenant.admin.settings.qr.premium', $tenant->slug) }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-semibold shadow"
                >
                    📥 Descargar QR Premium (PNG)
                </a>
            </div>

            <div class="mt-6 p-4 bg-amber-100 rounded-lg">
                <h3 class="font-semibold text-amber-800 mb-2">🎨 Personalización del QR Premium:</h3>
                <ul class="text-sm text-amber-700 space-y-1">
                    <li>• Texto superior: "Escanea nuestro menú"</li>
                    <li>• Logo centrado dentro del QR</li>
                    <li>• Nombre del negocio debajo del QR</li>
                    <li>• URL completa en la parte inferior</li>
                    <li>• Fondo color crema/café elegante</li>
                </ul>
            </div>
        </div>
    @endif  --}}

</div>

{{-- SCRIPT SVG → PNG (para QR normal) --}}
<script>
    function downloadQR() {
        const svg = document.querySelector('#qrSvgContainer svg');
        
        if (!svg) {
            alert("Primero genera el QR normal");
            return;
        }
        
        const svgData = new XMLSerializer().serializeToString(svg);
        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");
        const img = new Image();
        
        img.onload = function() {
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            
            const pngFile = canvas.toDataURL("image/png");
            const downloadLink = document.createElement("a");
            downloadLink.download = "qr-catalogo.png";
            downloadLink.href = pngFile;
            downloadLink.click();
        };
        
        img.src = "data:image/svg+xml;base64," + btoa(unescape(encodeURIComponent(svgData)));
    }
</script>

@endsection