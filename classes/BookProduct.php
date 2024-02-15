<?php
class BookProduct extends Product {
    protected $weight;

    public function __construct($sku, $name, $price, $productType,$extraArgument, $weight) {
        parent::__construct($sku, $name, $price, $productType); 

        $this->weight = $weight;
    }


    public function displayAttributes() {
        return  'Weight: ' . $this->weight . ' kg';
    }

    public function save($db) {
        $sql = "INSERT INTO products (sku, name, price, product_type, weight_kg) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $stmt->bind_param("ssdsi", $this->sku, $this->name, $this->price, $this->productType, $this->weight);
        $result = $stmt->execute();

        if (!$result) {
            die('Error executing query: ' . $stmt->error);
        }

        $stmt->close();

        return true; 
    }
}
