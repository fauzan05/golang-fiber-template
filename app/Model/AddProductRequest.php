<?php

namespace Fauzannurhidayat\Php\TokoOnline\Model;

class AddProductRequest
{
    public ?string $id = null;
    public ?string $name = null;
    public ?string $description = null;
    public ?string $category = null;
    public ?string $price = null;
    public ?string $color = null;
    public ?string $stock = null;
    public ?string $capacity = null;
    public ?array $image = null;
    public ?string $created_at = null;
    public ?string $modified_at = null;
}