<?php

namespace Fauzannurhidayat\Php\TokoOnline\Domain;

class Order
{
    public ?string $id;
    public string $userId;
    public string $total;
    public string $name;
    public string $paymentId;
    public string $orderId;
    public string $amount;
    public string $status;
    public string $productId;
    public string $productName;
    public string $category;
    public string $image;
    public string $price;
    public string $created_at_payment;
    public string $created_at_order;
}