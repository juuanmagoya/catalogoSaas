<!DOCTYPE html>
<html lang="es">

@include('tenant.public.partials.head')

<body class="bg-[#0a0a0a] text-gray-200">

<div class="min-h-screen bg-gradient-to-b from-[#0a0a0a] via-[#0a0a0a] to-[#050505]">

<!-- Eliminado el max-w-6xl y mx-auto para que ocupe todo el ancho -->
<div class="w-full">

@include('tenant.public.partials.header')

@include('tenant.public.partials.info-modal')

@include('tenant.public.partials.product-modal')

@include('tenant.public.partials.search')

@include('tenant.public.partials.categories')

@include('tenant.public.partials.products')

@if($tenant->hasFeature('cart'))
@include('tenant.public.partials.cart')
@endif

</div>

</div>

@include('tenant.public.partials.scripts')

</body>
</html>