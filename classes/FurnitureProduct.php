<?php
class FurnitureProduct extends Product {
    protected $height;
    protected $width;
    protected $length;

    public function __construct($sku, $name, $price, $productType, $extraArgument,$extraArgument2,$height, $width, $length) {
        parent::__construct($sku, $name, $price, $productType);

        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function displayAttributes() {
        return 'Dimensions: ' . $this->height . ' x ' . $this->width . ' x ' . $this->length;
    }

    public function save($db) {
        $sql = "INSERT INTO products (sku, name, price, product_type, height, width, length) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $stmt->bind_param("ssdsiii", $this->sku, $this->name, $this->price, $this->productType, $this->height, $this->width, $this->length);
        $result = $stmt->execute();

        if (!$result) {
            die('Error executing query: ' . $stmt->error);
        }

        $stmt->close();

        return true; 
    }
}

