<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Iniciar Sesión · {{ config('app.name', 'Restobar') }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-dvh flex items-center justify-center p-4 relative overflow-hidden antialiased" style="background: linear-gradient(135deg, #fef9f4 0%, #fff5ed 100%);">
    
    <!-- Elementos decorativos de fondo -->
    <div class="fixed pointer-events-none select-none text-[clamp(200px,30vw,400px)] opacity-[0.03] -bottom-20 -right-20 rotate-12">🍽️</div>
    <div class="fixed pointer-events-none select-none text-[clamp(150px,25vw,300px)] opacity-[0.03] -top-20 -left-20 -rotate-12">🍷</div>
    <div class="fixed pointer-events-none select-none text-[clamp(100px,20vw,200px)] opacity-[0.02] bottom-1/3 left-1/4">🍜</div>
    
    <!-- Onda decorativa inferior -->
    <div class="fixed bottom-0 left-0 w-full pointer-events-none">
        <svg class="w-full h-auto text-amber-100/20" viewBox="0 0 1200 120" preserveAspectRatio="none" fill="currentColor">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"/>
        </svg>
    </div>
    
    <!-- Tarjeta principal -->
    <div class="relative z-10 w-full max-w-md lg:max-w-lg animate-fade-in-up">
        
        <!-- Header -->
        <div class="bg-white/95 backdrop-blur-sm rounded-t-3xl pt-10 pb-6 px-6 text-center shadow-sm">
            
            <!-- Logo -->
            <div class="mb-6 inline-flex">
                <div class="w-24 h-24 rounded-2xl bg-amber-100 flex items-center justify-center shadow-md">
                    <span class="text-5xl">🍜</span>
                </div>
            </div>
            
            <!-- Título del restaurante -->
            <h1 class="font-display text-3xl lg:text-4xl font-bold text-stone-800 mb-2 tracking-tight">
                {{ config('app.name', 'Restobar') }}
            </h1>
            
            <!-- Lema -->
            <p class="text-amber-600 text-sm font-medium">
                Sabores que invitan a volver
            </p>
            
            <!-- Línea decorativa -->
            <div class="w-12 h-0.5 bg-orange-400 mx-auto mt-4 rounded-full"></div>
        </div>
        
        <!-- Cuerpo del formulario -->
        <div class="bg-white rounded-b-3xl px-6 pb-8 shadow-xl">
            
            <!-- Mensajes de sesión -->
            @if(session('status'))
                <div class="mb-5 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm text-center">
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- Errores de validación -->
            @if($errors->any())
                <div class="mb-5 p-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                    @foreach($errors->all() as $error)
                        <div class="flex items-center gap-2">
                            <span>⚠️</span>
                            <span>{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <!-- Campo Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">
                        Correo electrónico
                    </label>
                    <div class="relative group">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 group-focus-within:text-amber-500 transition-colors">
                            📧
                        </span>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                            autocomplete="email"
                            class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-stone-50 border-2 border-stone-200 focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:outline-none transition-all placeholder:text-stone-400"
                            placeholder="chef@restobar.com"
                        >
                    </div>
                </div>
                
                <!-- Campo Contraseña CON OJITO TOGGLE -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">
                        Contraseña
                    </label>
                    <div class="relative group">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 group-focus-within:text-amber-500 transition-colors z-10">
                            🔒
                        </span>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="w-full pl-9 pr-12 py-2.5 rounded-xl bg-stone-50 border-2 border-stone-200 focus:border-amber-400 focus:ring-4 focus:ring-amber-100 focus:outline-none transition-all placeholder:text-stone-400"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button"
                            id="togglePassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 hover:text-amber-600 transition-colors focus:outline-none"
                            aria-label="Mostrar u ocultar contraseña"
                        >
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-stone-400 mt-1.5">
                        👁️ Haz clic en el ojito para ver tu contraseña
                    </p>
                </div>
                
                <!-- Botón de acción -->
                <button 
                    type="submit" 
                    class="w-full mt-6 py-3 rounded-xl bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-200 text-white font-semibold text-base shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200"
                >
                    Iniciar sesión
                </button>
                
                <!-- Separador decorativo -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-stone-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-3 bg-white text-stone-400">✦</span>
                    </div>
                </div>
                
                <!-- Información de roles -->
                <div class="text-center space-y-2">
                    <p class="text-xs text-stone-400">
                        Acceso exclusivo para el equipo
                    </p>
                    <div class="flex flex-wrap justify-center gap-x-3 gap-y-1 text-stone-400 text-xs">
                        <span class="inline-flex items-center gap-1">🍳 Chef</span>
                        <span class="inline-flex items-center gap-1">🍷 Sommelier</span>
                        <span class="inline-flex items-center gap-1">👨‍🍳 Cocinero</span>
                        <span class="inline-flex items-center gap-1">🛎️ Mesero</span>
                        <span class="inline-flex items-center gap-1">📊 Gerencia</span>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="bg-amber-50/80 backdrop-blur-sm rounded-b-3xl py-3 px-6 text-center border-t border-amber-100">
            <p class="text-xs text-stone-500">
                🍷 Sistema de gestión gastronómica
            </p>
        </div>
    </div>
</body>

<!-- Estilos y JavaScript para el toggle de contraseña -->
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(24px);
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