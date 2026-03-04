<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body class="bg-neutral-100">

<div x-data="{ open: false }" class="min-h-screen flex">

    {{-- TOPBAR MOBILE --}}
    <header class="h-16 bg-neutral-900 border-b border-neutral-800 flex items-center px-4 sm:hidden fixed top-0 left-0 right-0 z-20">
        <button @click="open = true" class="text-amber-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <span class="ml-4 font-semibold text-amber-600 tracking-wide"
              style="font-family: 'Playfair Display', serif;">
            Panel SaaS
        </span>
    </header>

    {{-- OVERLAY --}}
    <div x-show="open"
         @click="open = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-30 sm:hidden"></div>

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- CONTENT --}}
    <div class="flex-1 sm:ml-64">

        <main class="p-6 pt-20 sm:pt-6">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')
<script>
function openDeleteModal(actionUrl, name) {
    const modal = document.getElementById('globalDeleteModal');
    const form = document.getElementById('globalDeleteForm');

    form.action = actionUrl;
    document.getElementById('globalDeleteName').innerText = name;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('globalDeleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
<x-delete-modal />
</body>
</html>