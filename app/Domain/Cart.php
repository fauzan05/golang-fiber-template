<?php

namespace Fauzannurhidayat\Php\TokoOnline\Domain;

class Cart
{
    public ?string $id;
    public string $sessionId;
    public string $productId;
    public ?string $quantity;
    public string $userId;
    public int $total; 
    public string $createdAt;
}