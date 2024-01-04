<?php
if (isset($_GET['sessionID']) && isset($_GET['date'])) {
    $sessionId = $_GET['sessionID'];
    $date = $_GET['date'];

    echo "<div>" . $date . " Session ID - " . $sessionId . "</div>";
    $products = [
        new Product("Iphone 15 Pro Max", "Smartphone", "1500$", "Apple", "Ultra KQmfjmnqwfmnowfm"),
        new Product("RTX 4090", "Graphics Card", "2000$", "NVIDIA", "ULTRA POWER VIDEOCARD"),
        new Product("Apple", "Food", "1.5$", "Nature", "yummy")
    ];

    foreach ($products as $product) {
        echo "<h2>" . $product->GetProduct() . "</h2>";
    }

} else {
    echo "No session ID found!";
}

class Product
{
    public $name;
    public $category;
    public $price;
    public $description;
    public $brand;

    public function __construct($name, $category, $price, $brand, $description)
    {
        $this->name = $name;
        $this->category = $category;
        $this->description = $description;
        $this->price = $price;
        $this->brand = $brand;
    }

    public function GetProduct(): string
    {
        return "Name: " . $this->name . " , Category: " . $this->category . " , Price: " . $this->price . " , Brand: " . $this->brand . " , Description: " . $this->description;
    }
}

?>
