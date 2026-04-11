<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Iniciar Sesión · {{ config('app.name', 'Restobar') }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-dvh flex items-center justify-center p-4 bg-neutral-50 antialiased">
    
    <!-- Contenedor principal -->
    <div class="w-full max-w-md animate-fade-in-up">
        
        <!-- Logo y marca -->
        <div class="text-center mb-10">
            <div class="inline-flex mb-6">
                <div class="w-16 h-16 rounded-xl bg-amber-100 flex items-center justify-center shadow-lg shadow-amber-100/50">
                    <span class="text-3xl">🍽️</span>
                </div>
            </div>
            
            <h1 class="font-display text-4xl font-medium text-neutral-800 mb-2 tracking-tight">
                {{ config('app.name', 'Restobar') }}
            </h1>
            
            <p class="text-amber-600 text-sm font-medium tracking-wide">
                Cocina de autor
            </p>
        </div>
        
        <!-- Tarjeta del formulario -->
        <div class="bg-white rounded-3xl p-8 shadow-xl shadow-neutral-200/50">
            
            <!-- Mensajes de sesión -->
            @if(session('status'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-sm text-emerald-800">{{ session('status') }}</span>
                    </div>
                </div>
            @endif
            
            <!-- Errores de validación -->
            @if($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-100">
                    @foreach($errors->all() as $error)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-sm text-rose-800">{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <!-- Título del formulario -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-neutral-800 mb-1">Bienvenido</h2>
                <p class="text-sm text-neutral-500">Ingresa tus credenciales para continuar</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <!-- Campo Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">
                        Correo electrónico
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        autocomplete="email"
                        class="w-full px-4 py-3 rounded-xl bg-neutral-50 border-0 ring-1 ring-neutral-200 focus:ring-2 focus:ring-amber-400 outline-none transition-all placeholder:text-neutral-400 text-neutral-800"
                        placeholder="tu@restobar.com"
                    >
                </div>
                
                <!-- Campo Contraseña -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-neutral-700">
                            Contraseña
                        </label>
                    </div>
                    <div class="relative">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="w-full px-4 py-3 pr-12 rounded-xl bg-neutral-50 border-0 ring-1 ring-neutral-200 focus:ring-2 focus:ring-amber-400 outline-none transition-all placeholder:text-neutral-400 text-neutral-800"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button"
                            id="togglePassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 p-2 rounded-lg text-neutral-400 hover:text-amber-600 hover:bg-amber-50 transition-all cursor-pointer"
                            aria-label="Mostrar u ocultar contraseña"
                        >
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Botón de acción -->
                <button 
                    type="submit" 
                    class="w-full mt-2 py-3.5 rounded-xl bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:ring-amber-200 text-white font-medium shadow-lg shadow-amber-200/50 hover:shadow-xl hover:shadow-amber-300/50 transition-all duration-200 cursor-pointer"
                >
                    Iniciar sesión
                </button>
            </form>
            
            <!-- Separador decorativo -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-neutral-100"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-4 bg-white text-neutral-300 text-xs tracking-wider">✦</span>
                </div>
            </div>
            
            <!-- Mensaje de acceso -->
            <div class="text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 border border-amber-100">
                    <span class="text-amber-500 text-sm">🔒</span>
                    <span class="text-xs font-medium text-amber-700">Acceso exclusivo para personal autorizado</span>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-xs text-neutral-400">
                © {{ date('Y') }} {{ config('app.name', 'Restobar') }} · Gestión gastronómica
            </p>
        </div>
    </div>
</body>

<!-- Estilos y JavaScript -->
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(16px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.5s ease-out forwards;
    }
    
    .font-display {
        font-family: 'Playfair Display', serif;
    }
    
    @media (max-width: 640px) {
        input, button {
            font-size: 16px;
        }
    }
</style>

<script>
    // Toggle de visibilidad de contraseña
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        let isPasswordVisible = false;
        
        if (toggleButton && passwordInput) {
            toggleButton.addEventListener('click', function() {
                // Cambiar el tipo de input
                passwordInput.type = isPasswordVisible ? 'password' : 'text';
                isPasswordVisible = !isPasswordVisible;
                
                // Cambiar el ícono del ojito
                const eyeIcon = document.getElementById('eyeIcon');
                if (isPasswordVisible) {
                    // Ojo tachado (contraseña visible)
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    `;
                } else {
                    // Ojo abierto (contraseña oculta)
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    `;
                }
            });
        }
    });
</script>
</html>