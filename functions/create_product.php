<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../classes/ProductFactory.php';
        require_once '../database/Database.php';

        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $productType = $_POST['productType'];
        $postData = $_POST;

        $productFactory = new ProductFactory();

        $product = $productFactory->createProduct($sku, $name, $price, $productType, $postData);

        $db = new Database();

        $result = $product->save($db);

        if ($result === true) {
            echo 'Product created successfully!';
        } else {
            echo 'Failed to create product.';
        }
    }
