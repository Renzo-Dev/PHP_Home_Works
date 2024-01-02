<?php

class Product
{
    public string $name;
    public float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}

class Category
{
    private $name = "";
    private $product_list = [];

    public function __construct($name, $product_list)
    {
        $this->name = $name;
        $this->product_list = $product_list;
    }

    public function GetCategoryName(): string
    {
        return $this->name;
    }

    public function GetProductList(): array
    {
        return $this->product_list;
    }
}

?>