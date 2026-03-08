@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-10 px-6">

{{-- Header --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">
        Configuración del negocio
    </h1>

    <p class="text-gray-500 mt-2">
        Aquí puedes editar la información pública de tu negocio. Estos datos pueden mostrarse
        en tu tienda, página web o enlaces de contacto para tus clientes.
    </p>
</div>

{{-- Mensaje de éxito --}}
@if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">
        {{ session('success') }}
    </div>
@endif

{{-- Card --}}
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
                        class="h-20 w-20 rounded-xl object-cover border">
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
                           hover:file:bg-blue-100">
            </div>

        </div>

        {{-- Grid principal --}}
        <div class="grid md:grid-cols-2 gap-6">

            {{-- Dirección --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Dirección
                </label>

                <input
                    type="text"
                    name="address"
                    value="{{ old('address', $tenant->address) }}"
                    placeholder="Ej: Av. Siempre Viva 123"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- WhatsApp --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Número de WhatsApp
                </label>

                <input
                    type="text"
                    name="whatsapp_number"
                    value="{{ old('whatsapp_number', $tenant->whatsapp_number) }}"
                    placeholder="+54 9 3777 000000"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Instagram --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Instagram
                </label>

                <input
                    type="text"
                    name="instagram"
                    value="{{ old('instagram', $tenant->instagram) }}"
                    placeholder="https://instagram.com/tu_negocio"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Facebook --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Facebook
                </label>

                <input
                    type="text"
                    name="facebook"
                    value="{{ old('facebook', $tenant->facebook) }}"
                    placeholder="https://facebook.com/tu_negocio"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Descripción / Horario de atención
            </label>

            <textarea
                name="description"
                rows="4"
                placeholder="Ej: Abrimos de lunes a viernes de 9:00 a 18:00"
                class="w-full border border-gray-300 rounded-lg px-4 py-2
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $tenant->description) }}</textarea>
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
                placeholder="Hola! Me gustaría hacer una consulta/pedido (Ejemplo)."
                class="w-full border border-gray-300 rounded-lg px-4 py-2
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Botón --}}
        <div class="pt-4 border-t flex justify-end">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold
                       px-8 py-3 rounded-lg shadow-md transition">
                Guardar cambios
            </button>

        </div>

    </form>

</div>
```

</div>

@endsection
