<?php
class products
{
    public $name;
    public $price;

    public function __construct($_name,$_price)
    {
        $this->name = $_name;
        $this->price = $_price;
    }
}
class Category
{
    private $name;
    private $list_products = array();

    public function __construct($_name,$_list_products = array())
    {
        $this->name = $_name;
        $this->list_products = $_list_products;
    }

    public function getCategoryName()
    {
        return $this->name;
    }

    public function getProductsOfCategory() : array
    {
        return $this->list_products;
    }

}
?>