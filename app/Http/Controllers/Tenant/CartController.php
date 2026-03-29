<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Tenant\Services\CartService;
use App\Support\TenantContext;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $data['quantity'] ?? 1;

        $cart = $this->cartService->add(
            $data['product_id'],
            $quantity
        );

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'cart' => $cart,
            'total' => $this->cartService->total()
        ]);
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer'
        ]);

        $cart = $this->cartService->remove($data['product_id']);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total' => $this->cartService->total()
        ]);
    }

    public function cart()
    {
        return response()->json([
            'cart' => $this->cartService->getCart(),
            'total' => $this->cartService->total()
        ]);
    }

    public function whatsapp()
    {
        $tenant = TenantContext::getTenant();

        $phone = $tenant->whatsapp_number;

        $message = $this->cartService->generateWhatsappMessage();

        return response()->json([
            'url' => "https://wa.me/{$phone}?text={$message}"
        ]);
    }
}