<?php

namespace Fauzannurhidayat\Php\TokoOnline\Model;


class AddToCartRequest
{
    public ?string $id = null;
    public ?string $userId = null;
    public ?string $stock = null;
    public ?int $total = null;
    public ?int $price = null;
    public ?string $sessionId = null;
    public ?string $productId = null;
    public ?string $quantity = null;
}