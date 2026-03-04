@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-semibold mb-8 tracking-wide text-neutral-800"
    style="font-family: 'Playfair Display', serif;">
    Panel Global SaaS
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Card 1 --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border-t-4 border-amber-600">
        <h3 class="text-neutral-500 text-sm uppercase tracking-wider">
            Tenants Activos
        </h3>
        <p class="text-3xl font-semibold mt-4 text-neutral-900">
            12
        </p>
    </div>

    {{-- Card 2 --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border-t-4 border-amber-600">
        <h3 class="text-neutral-500 text-sm uppercase tracking-wider">
            Planes
        </h3>
        <p class="text-3xl font-semibold mt-4 text-neutral-900">
            3
        </p>
    </div>

    {{-- Card 3 --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border-t-4 border-amber-600">
        <h3 class="text-neutral-500 text-sm uppercase tracking-wider">
            Ingresos Mensuales
        </h3>
        <p class="text-3xl font-semibold mt-4 text-amber-600">
            $2.450
        </p>
    </div>

</div>

@endsection