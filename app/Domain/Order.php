<?php

namespace Fauzannurhidayat\Php\TokoOnline\Domain;

class Order
{
    public ?string $id;
    public string $userId;
    public string $total;
    public string $paymentId;
    public string $orderId;
    public string $amount;
    public string $status;
    public string $productId;
}