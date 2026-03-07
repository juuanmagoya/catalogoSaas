@php
    $user = Auth::user();
@endphp

<aside
    :class="open ? 'translate-x-0' : '-translate-x-full sm:translate-x-0'"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-amber-900 text-amber-50
           transform transition-transform duration-200 ease-in-out flex flex-col shadow-xl">

    {{-- LOGO --}}
    <div class="h-20 flex items-center px-6 border-b border-amber-800">
        <span class="text-2xl tracking-wide"
              style="font-family: 'Playfair Display', serif;">
            Carta Digital
        </span>
    </div>

    {{-- MENU --}}
    <div class="flex-1 px-4 py-6 space-y-8 text-sm overflow-y-auto">

        {{-- PRINCIPAL --}}
        <div>
            <p class="text-xs text-amber-200 mb-3 tracking-wider uppercase">
                Principal
            </p>

            <a href=" {{ $user->isAdmin() ? route('admin.dashboard') : route('tenant.admin.dashboard', request()->route('subdomain')) }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg
                      hover:bg-amber-800 transition">
                Dashboard Admin
            </a>
        </div>

        {{-- ================= ADMIN ================= --}}
        @if($user->isAdmin())
        <div>
            <p class="text-xs text-amber-200 mb-3 tracking-wider uppercase">
                Gestión SaaS
            </p>

            <nav class="space-y-2">

                <a href="{{ route('admin.tenants.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                          hover:bg-amber-800 transition">
                    Negocios
                </a>

                <a href="{{ route('admin.plans.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                          hover:bg-amber-800 transition">
                    Planes
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                          hover:bg-amber-800 transition">
                    Suscripciones
                </a>

            </nav>
        </div>
        @endif


        {{-- ================= OWNER ================= --}}
        @if($user->isOwner())
        <div>
            <p class="text-xs text-amber-200 mb-3 tracking-wider uppercase">
                Mi Negocio
            </p>

            <nav class="space-y-2">

                <a href="{{ route('tenant.admin.categories.index', request()->route('subdomain')) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                          hover:bg-amber-800 transition">
                    Categorías
                </a>

                <a  href="{{ route('tenant.admin.products.index', request()->route('subdomain')) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                          hover:bg-amber-800 transition">
                    Productos
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                          hover:bg-amber-800 transition">
                    Configuración
                </a>

            </nav>
        </div>
        @endif

    </div>

    {{-- USER --}}
    <div class="border-t border-amber-800 p-4 text-sm bg-amber-950">

        <p class="font-medium">
            {{ $user->name }}
        </p>

        <p class="text-xs text-amber-300 capitalize">
            {{ $user->role }}
        </p>

        <a href="{{ route('profile.edit') }}"
           class="block mt-3 text-amber-300 hover:text-white transition">
            Perfil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="mt-2 text-red-300 hover:text-red-200 transition">
                Cerrar sesión
            </button>
        </form>
    </div>

</aside>