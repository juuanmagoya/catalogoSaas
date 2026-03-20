@extends('layouts.app')

@php
$tenant = request()->route('tenant');
@endphp

@section('content')

<h1 class="text-3xl font-semibold mb-8 tracking-wide text-neutral-800"
    style="font-family: 'Playfair Display', serif;">
    Panel del Negocio
</h1>

<p class="mb-10 text-neutral-600">
    Bienvenido, <span class="font-semibold text-neutral-900">{{ auth()->user()->name }}</span>
</p>

{{-- ================= METRIC CARDS ================= --}}

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

    <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-amber-600">
        <p class="text-sm text-neutral-500">Productos</p>
        <p class="text-3xl font-semibold mt-2">{{ $metrics['productsCount'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-amber-600">
        <p class="text-sm text-neutral-500">Categorías</p>
        <p class="text-3xl font-semibold mt-2">{{ $metrics['categoriesCount'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-amber-600">
        <p class="text-sm text-neutral-500">Visitas al menú</p>
        <p class="text-3xl font-semibold mt-2">{{ $metrics['menuViews'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-amber-600">
        <p class="text-sm text-neutral-500">Escaneos QR</p>
        <p class="text-3xl font-semibold mt-2">{{ $metrics['qrScans'] }}</p>
    </div>

</div>


{{-- ================= VISITS STATS ================= --}}

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <div class="bg-white p-6 rounded-2xl shadow-sm">
        <p class="text-sm text-neutral-500">Visitas Hoy</p>
        <p class="text-2xl font-semibold mt-2">
            {{ $metrics['visitsStats']['today'] }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm">
        <p class="text-sm text-neutral-500">Esta Semana</p>
        <p class="text-2xl font-semibold mt-2">
            {{ $metrics['visitsStats']['week'] }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm">
        <p class="text-sm text-neutral-500">Este Mes</p>
        <p class="text-2xl font-semibold mt-2">
            {{ $metrics['visitsStats']['month'] }}
        </p>
    </div>

</div>


{{-- ================= CHART ================= --}}

<div class="bg-white p-8 rounded-2xl shadow-sm mb-10">

    <h3 class="text-lg font-semibold mb-4">
        Visitas últimos 7 días
    </h3>

    <canvas id="visitsChart"></canvas>

</div>


{{-- ================= RANKINGS ================= --}}

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

    {{-- TOP PRODUCTOS --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm">

        <h3 class="text-lg font-semibold mb-4">
            Productos más vistos
        </h3>

        <ul class="space-y-3">

            @foreach($metrics['topProducts'] as $product)

            <li class="flex justify-between">

                <span>
                    {{ $product->name }}
                </span>

                <span class="font-semibold">
                    {{ $product->views }}
                </span>

            </li>

            @endforeach

        </ul>

    </div>


    {{-- TOP CATEGORIAS --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm">

        <h3 class="text-lg font-semibold mb-4">
            Categorías más visitadas
        </h3>

        <ul class="space-y-3">

            @foreach($metrics['topCategories'] as $category)

            <li class="flex justify-between">

                <span>
                    {{ $category->name }}
                </span>

                <span class="font-semibold">
                    {{ $category->views }}
                </span>

            </li>

            @endforeach

        </ul>

    </div>

</div>


{{-- ================= TRAFFIC SOURCES ================= --}}

<div class="bg-white p-6 rounded-2xl shadow-sm mb-10">

    <h3 class="text-lg font-semibold mb-4">
        Origen del tráfico
    </h3>

    <ul class="space-y-3">

        @foreach($metrics['trafficSources'] as $source)

        <li class="flex justify-between">

            <span class="capitalize">
                {{ $source->source ?? 'direct' }}
            </span>

            <span class="font-semibold">
                {{ $source->total }}
            </span>

        </li>

        @endforeach

    </ul>

</div>


{{-- ================= MANAGEMENT LINKS ================= --}}

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <a href="{{ route('tenant.admin.categories.index', $tenant) }}"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border-t-4 border-amber-600 block">

        <p class="text-xl font-semibold mt-2">Categorías</p>

    </a>

    <a href="{{ route('tenant.admin.products.index', $tenant) }}"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border-t-4 border-amber-600 block">

        <p class="text-xl font-semibold mt-2">Productos</p>

    </a>

    <a href="{{ route('tenant.admin.settings.edit', $tenant) }}"
       class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border-t-4 border-amber-600 block">

        <p class="text-xl font-semibold mt-2">Configuración</p>

    </a>

</div>


{{-- ================= CHART.JS ================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const visitsData = @json($metrics['visitsByDay']);

const labels = visitsData.map(v => v.date);
const data = visitsData.map(v => v.visits);

new Chart(document.getElementById('visitsChart'), {

    type: 'line',

    data: {

        labels: labels,

        datasets: [{

            label: 'Visitas',

            data: data,

            tension: 0.4

        }]

    }

});

</script>

