<?php

namespace Fauzannurhidayat\Php\TokoOnline\Domain;

class Product
{
    public ?string $id;
    public string $name;
    public string $description;
    public string $category;
    public string $color;
    public string $capacity;
    public string $stock;
    public string $image;
    public string $price;
    public ?string $created_at;
    public ?string $modified_at;
    public ?string $validation;
}