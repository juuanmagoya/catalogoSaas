<?php

namespace App\Domains\Tenant\Services;

use App\Domains\Catalog\Product\Models\Product;
use App\Support\TenantContext;


class CartService
{
    protected string $sessionKey;

    public function __construct()
    {
        $tenant = TenantContext::getTenant();

        $tenantId = $tenant ? $tenant->id : 'default';

        $this->sessionKey = "cart_{$tenantId}";
    }

    public function getCart(): array
    {
        return session()->get($this->sessionKey, []);
    }

    public function add(int $productId, int $quantity = 1): array
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {

            $cart[$productId]['quantity'] += $quantity;

        } else {

            $product = Product::findOrFail($productId);

            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }

        session()->put($this->sessionKey, $cart);

        return $cart;
    }

    public function remove(int $productId): array
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session()->put($this->sessionKey, $cart);

        return $cart;
    }

    public function total(): float
    {
        $cart = $this->getCart();

        return collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function clear(): void
    {
        session()->forget($this->sessionKey);
    }

    public function generateWhatsappMessage(): string
    {
        $cart = $this->getCart();

        if (empty($cart)) {
            return '';
        }

        $message = "🧾 *Nuevo pedido*\n\n";

        foreach ($cart as $item) {
            $message .= "• {$item['name']} x{$item['quantity']}\n";
        }

        $total = $this->total();

        $message .= "\n💰 *Total:* $" . number_format($total, 0, ',', '.');

        $message .= "\n\n📱 Pedido realizado desde el catálogo online";

        return urlencode($message);
    }
}