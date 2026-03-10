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
<img src="{{ Storage::url($tenant->logo_path) }}"
class="h-20 w-20 rounded-xl object-cover border">
@else
<div class="h-20 w-20 flex items-center justify-center rounded-xl bg-gray-100 text-gray-400 text-sm">
Sin logo
</div>
@endif

<input type="file"
name="logo"
class="block w-full text-sm border border-gray-300 rounded-lg px-3 py-2
file:mr-4 file:py-2 file:px-4 file:border-0
file:text-sm file:font-semibold
file:bg-blue-50 file:text-blue-700
hover:file:bg-blue-100">

</div>
</div>

{{-- Grid --}}
<div class="grid md:grid-cols-2 gap-6">

<div>
<label class="block text-sm font-semibold text-gray-700 mb-2">
Dirección
</label>

<input type="text"
name="address"
value="{{ old('address', $tenant->address) }}"
class="w-full border border-gray-300 rounded-lg px-4 py-2">
</div>

<div>
<label class="block text-sm font-semibold text-gray-700 mb-2">
Número de WhatsApp
</label>

<input type="text"
name="whatsapp_number"
value="{{ old('whatsapp_number', $tenant->whatsapp_number) }}"
class="w-full border border-gray-300 rounded-lg px-4 py-2">
</div>

<div>
<label class="block text-sm font-semibold text-gray-700 mb-2">
Instagram
</label>

<input type="text"
name="instagram"
value="{{ old('instagram', $tenant->instagram) }}"
class="w-full border border-gray-300 rounded-lg px-4 py-2">
</div>

<div>
<label class="block text-sm font-semibold text-gray-700 mb-2">
Facebook
</label>

<input type="text"
name="facebook"
value="{{ old('facebook', $tenant->facebook) }}"
class="w-full border border-gray-300 rounded-lg px-4 py-2">
</div>

</div>

{{-- Descripción --}}
<div>
<label class="block text-sm font-semibold text-gray-700 mb-2">
Descripción / Horario
</label>

<textarea name="description"
rows="4"
class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('description', $tenant->description) }}</textarea>
</div>

{{-- Mensaje WhatsApp --}}
<div>
<label class="block text-sm font-semibold text-gray-700 mb-2">
Mensaje automático de WhatsApp
</label>

<input type="text"
name="whatsapp_message"
value="{{ old('whatsapp_message', $tenant->whatsapp_message) }}"
class="w-full border border-gray-300 rounded-lg px-4 py-2">
</div>

<div class="pt-4 border-t flex justify-end">

<button type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white font-semibold
px-8 py-3 rounded-lg shadow-md transition">
Guardar cambios
</button>

</div>

</form>
</div>


{{-- ===================== --}}
{{-- SECCIÓN QR DEL CATÁLOGO --}}
{{-- ===================== --}}

<div class="bg-white shadow-xl rounded-2xl border border-gray-100 p-8 mt-8">

<h2 class="text-xl font-bold text-gray-800 mb-2">
QR de tu catálogo
</h2>

<p class="text-gray-500 mb-6">
Este QR permite que tus clientes accedan directamente a tu catálogo digital.
Puedes descargarlo en diferentes formatos según cómo quieras compartirlo.
</p>

@php
$catalogUrl = config('app.url') . '/' . $tenant->slug;
@endphp

{{-- URL catálogo --}}
<div class="flex gap-3 mb-8">

<input type="text"
value="{{ $catalogUrl }}"
readonly
class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-gray-700">

<button onclick="navigator.clipboard.writeText('{{ $catalogUrl }}')"
class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
Copiar
</button>

</div>

{{-- Generar QR --}}
<div class="mb-6">

<a href="{{ route('tenant.admin.settings.qr', $tenant->slug) }}"
class="bg-blue-600 hover:bg-blue-700 text-white font-semibold
px-6 py-3 rounded-lg shadow transition">

Generar QR

</a>

</div>


{{-- Mostrar QR --}}
@isset($qrCode)

<div class="text-center">

<div class="inline-block p-6 bg-gray-50 rounded-xl border">

<div id="qrSvgContainer">
{!! $qrCode !!}
</div>

</div>


{{-- Botones --}}
<div class="flex flex-wrap justify-center gap-4 mt-6">

{{-- SVG --}}
<a href="{{ route('tenant.admin.settings.qr.download', $tenant->slug) }}"
class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg text-sm">

Descargar SVG  
<span class="block text-xs opacity-80">Ideal para imprenta</span>

</a>

{{-- PNG --}}
<button onclick="downloadQR()"
class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm">

Descargar PNG  
<span class="block text-xs opacity-80">Ideal para WhatsApp</span>

</button>

{{-- Poster --}}
<a href="{{ route('tenant.admin.settings.qr.poster', $tenant->slug) }}"
class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm">

Cartel para imprimir  
<span class="block text-xs opacity-80">Perfecto para mesas o vidrieras</span>

</a>

</div>

</div>

@endisset

</div>

</div>


{{-- ===================== --}}
{{-- SCRIPT SVG → PNG --}}
{{-- ===================== --}}

<script>

function downloadQR(){

const svgElement = document.querySelector('#qrSvgContainer svg');

const svgData = new XMLSerializer().serializeToString(svgElement);

const canvas = document.createElement("canvas");

const ctx = canvas.getContext("2d");

const img = new Image();

img.onload = function(){

canvas.width = img.width;
canvas.height = img.height;

ctx.drawImage(img,0,0);

const pngFile = canvas.toDataURL("image/png");

const downloadLink = document.createElement("a");

downloadLink.download = "qr-catalogo.png";

downloadLink.href = pngFile;

downloadLink.click();

};

img.src = "data:image/svg+xml;base64," + btoa(svgData);

}

</script>

@endsection