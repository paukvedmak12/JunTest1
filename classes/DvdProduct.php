<?php
class DvdProduct extends Product {
    protected $size;

    public function __construct($sku, $name, $price, $productType, $size) {
        parent::__construct($sku, $name, $price, $productType);

        $this->size = $size;
    }

    public function displayAttributes() {
        return 'Size: ' . $this->size . ' MB';
    }

    public function save($db) {
        $sql = "INSERT INTO products (sku, name, price, product_type, size_mb) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        if (!$stmt) {
            die('Error preparing query: ' . $db->error);
        }

        $stmt->bind_param("ssdsd", $this->sku, $this->name, $this->price, $this->productType, $this->size);
        $result = $stmt->execute();

        if (!$result) {
            die('Error executing query: ' . $stmt->error);
        } else {
            echo "dvd Product saved successfully.";
        }

        $stmt->close();

        return true;
    }

   
               
}