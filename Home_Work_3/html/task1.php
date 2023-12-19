<?php
class Category
{
    public $name, $list_products;

    public function __construct($_name,$_list_products)
    {
        $this->name = $_name;
        $this->list_products = $_list_products;
    }
}


?>