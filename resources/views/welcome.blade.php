<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Optimizado -->
    <title>Menuvya · Catálogo Digital y Menú | Aumenta tus Ventas</title>
    <meta name="description" content="Crea tu catálogo digital profesional en minutos. Menú QR para restaurantes, carta digital interactiva y panel de control. +500 negocios ya aumentaron sus ventas.">
    <meta name="keywords" content="menú digital, carta digital QR, catálogo digital para negocios, menú digital para restaurantes, catálogo online productos, carta digital restaurante, menú QR, catálogo interactivo">
    <meta name="author" content="Menuvya">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Redes Sociales -->
    <meta property="og:title" content="Menuvya · Catálogo Digital Profesional">
    <meta property="og:description" content="Transforma tu negocio con un menú digital interactivo. Aumenta tus ventas y moderniza tu carta.">
    <meta property="og:type" content="website">
    
    <!-- Tailwind CSS y Fuentes -->
    <!--<script src="https://cdn.tailwindcss.com"></script> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite con archivos específicos para landing -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: #0b1120;
            scroll-behavior: smooth;
        }
        
        /* Animaciones personalizadas */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        /* Clases para scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.2, 0.9, 0.3, 1);
        }
        
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Efectos de tarjetas */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(145deg, #1e293b, #1a2234);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: rgba(236, 72, 153, 0.3);
            box-shadow: 0 20px 40px -15px rgba(236, 72, 153, 0.3);
        }
        
        /* Gradientes personalizados */
        .gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #a855f7 50%, #ec4899 100%);
        }
        
        .gradient-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
        }
        
        .gradient-border {
            position: relative;
            background: linear-gradient(145deg, #1e293b, #0f172a);
        }
        
        .gradient-border::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #4f46e5, #ec4899);
            border-radius: 1rem;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .gradient-border:hover::before {
            opacity: 1;
        }
        
        /* Botón CTA */
        .btn-cta {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #0b1120;
            font-weight: 700;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-cta:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.5);
        }
        
        .btn-cta::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
            transform: rotate(30deg);
            transition: 0.6s;
            opacity: 0;
        }
        
        .btn-cta:hover::after {
            opacity: 1;
            transform: rotate(30deg) translate(20%, 20%);
        }
        
        /* Badge Plan Pro */
        .badge-pro {
            position: absolute;
            top: -12px;
            right: 20px;
            background: linear-gradient(135deg, #ec4899, #a855f7);
            padding: 4px 20px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 5px 15px rgba(236, 72, 153, 0.4);
        }
        
        /* Números de paso */
        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4f46e5, #ec4899);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 700;
            transform: rotate(5deg);
            transition: 0.3s;
        }
        
        .card-hover:hover .step-number {
            transform: rotate(0deg) scale(1.1);
        }
        
        /* Glassmorphism */
        .glass-effect {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        /* Estilos para móvil */
        @media (max-width: 768px) {
            .step-number {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
        }

        .whatsapp-button{
            position: fixed;
            bottom: 25px;
            right: 25px;
            background: #25D366;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 10px 25px rgba(0,0,0,0.3);
            transition: all .3s ease;
            z-index:1000;
            animation: whatsappPulse 2s infinite;
        }

        .whatsapp-button:hover{
            transform: scale(1.1);
            box-shadow:0 15px 35px rgba(0,0,0,0.4);
        }

        @keyframes whatsappPulse{
            0%{
                box-shadow:0 0 0 0 rgba(37,211,102,0.6);
            }
            70%{
                box-shadow:0 0 0 15px rgba(37,211,102,0);
            }
            100%{
                box-shadow:0 0 0 0 rgba(37,211,102,0);
            }
        }

    </style>
</head>
<body class="text-white antialiased">

<!-- Fondo con efecto -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-0 left-0 w-full h-full bg-[#0b1120]"></div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-glow"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-pink-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-glow" style="animation-delay: 1s;"></div>
</div>


<!-- HERO SECTION -->
<section class="relative pt-20 pb-28 overflow-hidden">
    <div class="container mx-auto px-4 md:px-6 max-w-7xl relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Contenido izquierdo -->
            <div class="reveal">
                <!-- Trust badge -->
                <div class="inline-flex items-center gap-2 glass-effect px-4 py-2 rounded-full mb-8">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium text-gray-300">+500 negocios ya usan Menuvya para mostrar su catálogo online</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                    Crea el catálogo digital de tu negocio
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-400">
                        en menos de 10 minutos
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-300 mb-8 leading-relaxed">
                    Muestra tus productos online, comparte tu menú con QR y
                    <span class="font-semibold text-yellow-300">
                    vende más sin imprimir cartas
                    </span>.
                    Todo desde un panel simple.
                </p>
                
                <!-- Beneficios rápidos -->
                <div class="grid grid-cols-2 gap-4 mb-10">
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-300 text-xl">✓</span>
                        <span class="text-sm md:text-base">Sin comisiones</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-300 text-xl">✓</span>
                        <span class="text-sm md:text-base">Actualización instantánea</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-300 text-xl">✓</span>
                        <span class="text-sm md:text-base">QR personalizado</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-300 text-xl">✓</span>
                        <span class="text-sm md:text-base">Soporte prioritario</span>
                    </div>
                </div>
                
                <!-- CTA -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#pricing" class="btn-cta px-8 py-4 rounded-xl text-lg font-bold text-center group">
                        Crear mi catálogo ahora →
                        <span class="inline-block transition-transform group-hover:translate-x-1 ml-2">→</span>
                    </a>
                    <a href="#como-funciona" class="glass-effect border border-white/10 hover:border-white/30 px-8 py-4 rounded-xl text-lg font-bold text-center transition">
                        Cómo funciona
                    </a>
                </div>
            </div>
            
            <!-- Imagen derecha -->
            <div class="relative reveal" style="transition-delay: 0.2s;">
                <div class="absolute -inset-1 gradient-primary rounded-3xl blur-2xl opacity-30 animate-pulse-glow"></div>
                <div class="relative glass-effect rounded-3xl p-2">
                    <img 
                        src="{{ asset('storage/logomenuvya.png') }}"
                        alt="Logo menuvya"
                        class="rounded-2xl drop-shadow-2xl w-[520px] md:w-[620px]"
                    >
                    
                    <!-- Badge flotante -->
                    <div class="absolute -bottom-6 -left-6 glass-effect rounded-2xl p-4 animate-float">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl">📱</span>
                            <div>
                                <p class="font-bold text-sm">Escanea y pide</p>
                                <p class="text-xs text-gray-400">Sin descargar apps</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LOGOS / CONFIANZA -->
<section class="py-12 border-y border-white/5 glass-effect">
    <div class="container mx-auto px-4 max-w-7xl">
        <p class="text-center text-gray-400 mb-8 text-sm uppercase tracking-wider">Utilizado por negocios de todo tipo</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center opacity-60">
            <div class="text-2xl font-light">🍔 Restaurantes</div>
            <div class="text-2xl font-light">☕ Cafeterías</div>
            <div class="text-2xl font-light">🍕 Pizzerías</div>
            <div class="text-2xl font-light">🏪 Tiendas</div>
        </div>
    </div>
</section>

<!-- BENEFICIOS PRINCIPALES -->
<section class="py-24">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                ¿Por qué tener un <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-400">catálogo digital?</span>
            </h2>
            <p class="text-gray-400 text-lg">
                Digitaliza tu catálogo y permite que tus clientes
                vean tus productos desde su celular en segundos.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Beneficio 1 -->
            <div class="card-hover rounded-2xl p-8 reveal">
                <div class="text-5xl mb-4">📈</div>
                <h3 class="text-2xl font-bold mb-3">Aumenta tus ventas</h3>
                <p class="text-gray-400 leading-relaxed">
                    Los clientes compran un 40% más cuando ven fotos profesionales y descripciones atractivas de tus productos.
                </p>
            </div>
            
            <!-- Beneficio 2 -->
            <div class="card-hover rounded-2xl p-8 reveal" style="transition-delay: 0.1s;">
                <div class="text-5xl mb-4">⚡</div>
                <h3 class="text-2xl font-bold mb-3">Actualización instantánea</h3>
                <p class="text-gray-400 leading-relaxed">
                    Cambia precios, agrega productos o promociones en segundos. Sin costos de impresión ni esperas.
                </p>
            </div>
            
            <!-- Beneficio 3 -->
            <div class="card-hover rounded-2xl p-8 reveal" style="transition-delay: 0.2s;">
                <div class="text-5xl mb-4">📱</div>
                <h3 class="text-2xl font-bold mb-3">Comparte con QR</h3>
                <p class="text-gray-400 leading-relaxed">
                    Un solo código QR en mesas, redes o WhatsApp y tus clientes ven tu catálogo al instante.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CÓMO FUNCIONA -->
<section id="como-funciona" class="py-24 relative">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Comienza en <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-400">3 pasos simples</span>
            </h2>
            <p class="text-gray-400 text-lg">
                En menos de 10 minutos tienes tu catálogo digital funcionando.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Paso 1 -->
            <div class="card-hover rounded-2xl p-8 text-center reveal">
                <div class="step-number mx-auto mb-6">1</div>
                <h3 class="text-xl font-bold mb-3">Habla con nosotros por WhatsApp</h3>
                <p class="text-gray-400">
                    Regístrate con tu email y accede al panel de control intuitivo.
                </p>
            </div>
            
            <!-- Paso 2 -->
            <div class="card-hover rounded-2xl p-8 text-center reveal" style="transition-delay: 0.1s;">
                <div class="step-number mx-auto mb-6">2</div>
                <h3 class="text-xl font-bold mb-3">Sube tus productos</h3>
                <p class="text-gray-400">
                    Agrega fotos, precios y organiza por categorías fácilmente.
                </p>
            </div>
            
            <!-- Paso 3 -->
            <div class="card-hover rounded-2xl p-8 text-center reveal" style="transition-delay: 0.2s;">
                <div class="step-number mx-auto mb-6">3</div>
                <h3 class="text-xl font-bold mb-3">Recibe tu QR y empieza a vender</h3>
                <p class="text-gray-400">
                    Descarga tu código QR y compártelo donde quieras. ¡Listo!
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES / CARACTERÍSTICAS -->
<section class="py-24">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Lista de features -->
            <div class="reveal">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Todo lo que necesitas en un 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-400">panel simple</span>
                </h2>
                <p class="text-gray-400 text-lg mb-8">
                    No necesitas ser experto en tecnología. Nuestro panel es intuitivo y fácil de usar.
                </p>
                
                <div class="space-y-5">
                    <div class="flex items-start gap-4">
                        <span class="text-yellow-300 text-xl mt-1">✓</span>
                        <div>
                            <h3 class="font-bold text-lg">Organización por categorías</h3>
                            <p class="text-gray-400">Agrupa tus productos como quieras: entradas, platos fuertes, postres, bebidas.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <span class="text-yellow-300 text-xl mt-1">✓</span>
                        <div>
                            <h3 class="font-bold text-lg">Imágenes profesionales</h3>
                            <p class="text-gray-400">Muestra tus productos con fotos de alta calidad que inviten a comprar.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <span class="text-yellow-300 text-xl mt-1">✓</span>
                        <div>
                            <h3 class="font-bold text-lg">QR personalizable</h3>
                            <p class="text-gray-400">Puedes agregar tu logo y colores al código QR (plan Pro).</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Imagen / Mockup -->
            <div class="relative reveal" style="transition-delay: 0.2s;">
                <div class="absolute -inset-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-3xl blur-2xl opacity-20"></div>
                <div class="relative glass-effect rounded-3xl p-2">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&auto=format" 
                         alt="Panel de control Menuvya" 
                         class="rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRICING -->
<section id="pricing" class="py-24">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Planes simples<span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-400">para tu negocio</span>
            </h2>
            <p class="text-gray-400 text-lg">
                Elige el plan que mejor se adapte a tu negocio. Sin contratos largos.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Plan Básico -->
            <div class="card-hover rounded-3xl p-8 reveal relative">
                <h3 class="text-2xl font-bold mb-2">Básico</h3>
                <p class="text-gray-400 mb-6">Para negocios que están comenzando</p>
                
                <div class="mb-8">
                    <span class="text-5xl font-bold">$10.000</span>
                    <span class="text-gray-400">/mes</span>
                </div>
                
                <ul class="space-y-4 mb-10">
                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>Hasta 50 productos</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>Hasta 5 categorías</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>Catálogo online</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>Código QR</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>Panel de administración</span>
                    </li>
                </ul>
                
                <a href="https://wa.me/5493425458284?text=Hola%21%20%F0%9F%91%8B%0A%0AQuiero%20crear%20el%20cat%C3%A1logo%20digital%20de%20mi%20negocio%20con%20Menuvya.%0A%0AMe%20interesa%20el%20Plan%20B%C3%A1sico%20%28%2410.000%2Fmes%29.%0A%0A%C2%BFPodr%C3%ADan%20ayudarme%20a%20activarlo%20y%20crear%20mi%20cuenta%3F"
                target="_blank"
                class="btn-cta px-6 py-4 rounded-xl font-semibold block text-center">
                    Comenzar con Básico
                </a>
            </div>
            
            <!-- Plan Pro (Destacado) -->
            <div class="card-hover rounded-3xl p-8 reveal relative transform lg:scale-105 border-2 border-pink-500/30" style="transition-delay: 0.1s;">

                <div class="badge-pro">MÁS POPULAR</div>

                <h3 class="text-2xl font-bold mb-2">Plan Pro</h3>
                <p class="text-gray-400 mb-6">Para negocios que quieren vender más</p>

                <div class="mb-8">
                    <span class="text-5xl font-bold">$15.000</span>
                    <span class="text-gray-400">/mes</span>
                </div>

                <ul class="space-y-4 mb-10">

                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span class="font-bold">Productos ilimitados</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span class="font-bold">Categorías ilimitadas</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>QR personalizado con tu marca</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span class="font-bold">Sistema de pedidos Sin Comisiones</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>Productos destacados</span>
                    </li>

                    <!--<li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>Estadísticas de visitas</span>
                    </li> -->

                    <li class="flex items-center gap-3">
                        <span class="text-yellow-300">✓</span>
                        <span>Soporte prioritario</span>
                    </li>

                </ul>

                <a href="https://wa.me/5493425458284?text=Hola%21%20%F0%9F%91%8B%0A%0AQuiero%20crear%20el%20cat%C3%A1logo%20digital%20de%20mi%20negocio%20con%20Menuvya.%0A%0AMe%20interesa%20el%20Plan%20Pro%20%28%2415.000%2Fmes%29%20con%20carrito%20de%20pedidos%20y%20WhatsApp.%0A%0A%C2%BFPodr%C3%ADan%20ayudarme%20a%20activarlo%3F"
                target="_blank"
                class="btn-cta px-6 py-4 rounded-xl font-semibold block text-center">

                    Elegir Plan Pro

                </a>

                <p class="text-center text-sm text-gray-400 mt-4">
                    Ideal para restaurantes, tiendas y negocios con muchos productos
                </p>

            </div>

            <!-- Plan Premium -->
            <div class="card-hover rounded-3xl p-8 reveal relative border border-purple-500/30"
                style="transition-delay: 0.2s;">

                <h3 class="text-2xl font-bold mb-2">Premium</h3>
                <p class="text-gray-400 mb-6">Para negocios que quieren vender más</p>

                <div class="mb-8">
                    <span class="text-5xl font-bold">$25.000</span>
                    <span class="text-gray-400">/mes</span>
                </div>

                <ul class="space-y-4 mb-10">

                    <li class="flex items-center gap-3">
                        <span class="text-purple-400">✓</span>
                        <span class="font-bold">Productos ilimitados</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-purple-400">✓</span>
                        <span>Categorías ilimitadas</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-purple-400">✓</span>
                        <span class="font-bold">Pedidos por WhatsApp con carrito</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-purple-400">✓</span>
                        <span>QR totalmente personalizado con logo</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-purple-400">✓</span>
                        <span>Diseño del catálogo con tu marca</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-purple-400">✓</span>
                        <span>Estadísticas avanzadas</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-purple-400">✓</span>
                        <span>Soporte prioritario</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-purple-400">✓</span>
                        <span>Acceso anticipado a nuevas funciones</span>
                    </li>

                </ul>

                <a href="https://wa.me/5493425458284?text=Hola%21%20%F0%9F%91%8B%0A%0AQuiero%20crear%20el%20cat%C3%A1logo%20digital%20de%20mi%20negocio%20con%20Menuvya.%0A%0AMe%20interesa%20el%20Plan%20Premium%20%28%2425.000%2Fmes%29%20con%20pedidos%20por%20WhatsApp.%0A%0A%C2%BFPodr%C3%ADan%20ayudarme%20a%20activarlo%3F"
                target="_blank"
                class="btn-cta px-6 py-4 rounded-xl font-semibold block text-center">

                    Elegir Plan Premium

                </a>

                <p class="text-center text-sm text-gray-400 mt-4">
                    Ideal para restaurantes y negocios con alto volumen
                </p>

            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-24">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Preguntas <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-400">frecuentes</span>
            </h2>
            <p class="text-gray-400 text-lg">
                Resolvemos tus dudas para que empieces con confianza.
            </p>
        </div>
        
        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="glass-effect rounded-2xl p-6 reveal">
                <button class="faq-btn w-full text-left flex justify-between items-center" onclick="toggleFaq(this)">
                    <h3 class="font-bold text-lg">¿Necesito conocimientos técnicos para usar la plataforma?</h3>
                    <span class="text-2xl ml-4">+</span>
                </button>
                <div class="faq-content hidden mt-4 text-gray-400">
                    No, para nada. Nuestra plataforma está diseñada para que cualquier persona pueda crear y administrar su catálogo sin conocimientos técnicos. Es tan fácil como subir fotos y escribir precios.
                </div>
            </div>
            
            <!-- FAQ 2 -->
            <div class="glass-effect rounded-2xl p-6 reveal">
                <button class="faq-btn w-full text-left flex justify-between items-center" onclick="toggleFaq(this)">
                    <h3 class="font-bold text-lg">¿Puedo cambiar de plan en cualquier momento?</h3>
                    <span class="text-2xl ml-4">+</span>
                </button>
                <div class="faq-content hidden mt-4 text-gray-400">
                    Sí, puedes actualizar o cancelar tu plan cuando quieras. Si necesitas más funciones, puedes migrar al Plan Pro en un clic.
                </div>
            </div>
            
            <!-- FAQ 3 -->
            <div class="glass-effect rounded-2xl p-6 reveal">
                <button class="faq-btn w-full text-left flex justify-between items-center" onclick="toggleFaq(this)">
                    <h3 class="font-bold text-lg">¿Cómo comparto mi catálogo con mis clientes?</h3>
                    <span class="text-2xl ml-4">+</span>
                </button>
                <div class="faq-content hidden mt-4 text-gray-400">
                    Te generamos un código QR único que puedes imprimir y poner en tus mesas, o compartir el link directo por WhatsApp, Instagram o Facebook. Tus clientes abren el catálogo en su celular sin descargar nada.
                </div>
            </div>
            
            <!-- FAQ 4 -->
            <div class="glass-effect rounded-2xl p-6 reveal">
                <button class="faq-btn w-full text-left flex justify-between items-center" onclick="toggleFaq(this)">
                    <h3 class="font-bold text-lg">¿Qué pasa si supero los 50 productos del plan Básico?</h3>
                    <span class="text-2xl ml-4">+</span>
                </button>
                <div class="faq-content hidden mt-4 text-gray-400">
                    Si tu negocio crece y necesitas más productos, puedes actualizar al plan Pro que tiene productos ilimitados. La migración es inmediata y no pierdes ningún dato.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section class="py-24">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="gradient-primary rounded-3xl p-12 text-center relative overflow-hidden reveal">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Crea tu catálogo digital hoy y empieza a vender más
                </h2>
                <p class="text-xl mb-8 text-indigo-100">
                    Únete a +500 negocios que ya modernizaron su catálogo.
                </p>

                <p class="mt-6 text-indigo-200 text-sm">
                ✨ Activación en minutos · Sin contratos · Cancela cuando quieras
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="https://wa.me/5493425458284?text=Hola%21%20%F0%9F%91%8B%0A%0AQuiero%20crear%20el%20cat%C3%A1logo%20digital%20de%20mi%20negocio%20con%20Menuvya.%0A%0AMe%20gustar%C3%ADa%20recibir%20informaci%C3%B3n%20para%20comenzar%20y%20activar%20mi%20cuenta."
                    target="_blank"
                    class="btn-cta px-10 py-5 rounded-xl text-xl font-bold group">
                        Crear mi catálogo ahora
                        <span class="inline-block transition-transform group-hover:translate-x-1 ml-2">→</span>
                    </a>
                    <a href="#pricing" class="glass-effect border border-white/30 hover:bg-white/10 px-10 py-5 rounded-xl text-xl font-bold transition">
                        Ver planes
                    </a>
                </div>
                
                <p class="mt-6 text-indigo-200 text-sm">
                    ✨ Comienza en minutos · Soporte incluido · Cancela cuando quieras
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="border-t border-white/5 py-16">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid md:grid-cols-4 gap-10">
            <!-- Columna 1 -->
            <div>
                <h3 class="text-2xl font-bold mb-4">Menuvya</h3>
                <p class="text-gray-400 text-sm">
                    El catálogo digital más simple y efectivo para tu negocio.
                </p>
            </div>
            
            <!-- Columna 2 -->
            <div>
                <h4 class="font-bold mb-4">Producto</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#pricing" class="hover:text-white transition">Precios</a></li>
                    <li><a href="#como-funciona" class="hover:text-white transition">Cómo funciona</a></li>
                    <li><a href="#" class="hover:text-white transition">Características</a></li>
                </ul>
            </div>
            
            <!-- Columna 3 -->
            <div>
                <h4 class="font-bold mb-4">Recursos</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    <li><a href="#" class="hover:text-white transition">Guía del menú digital</a></li>
                    <li><a href="#" class="hover:text-white transition">Casos de éxito</a></li>
                </ul>
            </div>
            
            <!-- Columna 4 -->
            <div>
                <h4 class="font-bold mb-4">Legal</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Términos y condiciones</a></li>
                    <li><a href="#" class="hover:text-white transition">Política de privacidad</a></li>
                    <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                </ul>
            </div>
        </div>
        
        <div class="mt-12 pt-8 border-t border-white/5 text-center text-gray-400 text-sm">
            © 2026 Menuvya. Todos los derechos reservados. Hecho para ayudarte a vender más.
        </div>
    </div>
</footer>

<!-- BOTON WHATSAPP FLOTANTE -->
<a href="https://wa.me/5493425458284?text=Hola%21%20%F0%9F%91%8B%0A%0AQuiero%20crear%20el%20cat%C3%A1logo%20digital%20de%20mi%20negocio%20con%20Menuvya.%0A%0AMe%20gustar%C3%ADa%20recibir%20informaci%C3%B3n%20para%20comenzar."
    target="_blank"
    title="Hablar por WhatsApp"
    class="whatsapp-button">

    <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 32 32"
        class="w-7 h-7 fill-white">
        <path d="M16.001 3C8.82 3 3 8.82 3 16a12.9 12.9 0 0 0 1.78 6.55L3 29l6.67-1.75A13 13 0 1 0 16 3zm0 23.6c-1.9 0-3.76-.5-5.39-1.45l-.38-.22-3.96 1.04 1.05-3.86-.25-.4A10.6 10.6 0 1 1 16 26.6zm5.85-7.97c-.32-.16-1.88-.93-2.17-1.03-.29-.1-.5-.16-.7.16-.2.32-.8 1.03-.98 1.24-.18.2-.36.24-.67.08-.32-.16-1.35-.5-2.57-1.6-.95-.85-1.6-1.9-1.78-2.22-.18-.32-.02-.49.14-.65.14-.14.32-.36.48-.54.16-.18.22-.32.32-.54.1-.2.05-.38-.03-.54-.08-.16-.7-1.68-.96-2.3-.25-.6-.5-.52-.7-.52h-.6c-.2 0-.54.08-.82.38-.29.32-1.1 1.08-1.1 2.63s1.13 3.04 1.29 3.26c.16.22 2.2 3.36 5.34 4.72.75.32 1.34.5 1.8.64.76.24 1.45.2 2 .12.61-.09 1.88-.77 2.14-1.52.27-.75.27-1.4.19-1.52-.08-.12-.29-.2-.6-.36z"/>
    </svg>

</a>



<!-- JavaScript -->
<script>
    // Scroll Reveal
    const revealElements = document.querySelectorAll('.reveal');
    
    function checkReveal() {
        revealElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementTop < windowHeight - 100) {
                element.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', checkReveal);
    window.addEventListener('load', checkReveal);
    
    // FAQ Toggle
    function toggleFaq(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('span:last-child');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.textContent = '−';
        } else {
            content.classList.add('hidden');
            icon.textContent = '+';
        }
    }
    
    // Smooth scroll para enlaces internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Efecto hover en tarjetas
    const cards = document.querySelectorAll('.card-hover');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-8px) scale(1.02)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
        });
    });
</script>
</body>
</html>