<?php

namespace Fauzannurhidayat\Php\TokoOnline\Model;

class BuyNowRequest
{
    public ?string $id = null;
    public ?string $userId = null;
    public ?int $total = null;
    public ?int $stock = null;
    public ?string $paymentId = null;
    public ?string $orderId = null;
    public ?string $amount = null;
    public ?string $status = null;
    public ?int $price = null;
    public ?string $productId = null;
    public ?int $balanceUser = null;
}