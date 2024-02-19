<?php
// ProductFactory.php
require_once '../database/Database.php';
require_once 'Product.php';
require_once 'BookProduct.php';
require_once 'DvdProduct.php';
require_once 'FurnitureProduct.php';

class ProductFactory {
    public static function createProduct($sku, $name, $price, $productType, $postData) {
        $productType = ucfirst(strtolower($productType));

        $className = $productType . 'Product';

        if (!class_exists($className)) {
            die('Failed: Invalid product type.');
        }

        $db = new Database();
        $existingProduct = $db->query("SELECT COUNT(*) AS count FROM products WHERE sku = ?", [$sku])->fetch_assoc();

        if ($existingProduct['count'] > 0) {
            http_response_code(409);
            die('Failed'); 
        }


        $reflectionClass = new ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();
        $params = $constructor->getParameters();
        $args = [];

        foreach ($params as $param) {
            $paramName = $param->getName();
            if (isset($postData[$paramName])) {
                $args[] = $postData[$paramName];
            } else {
                $args[] = null;
            }
        }

    
        return $reflectionClass->newInstanceArgs($args);
    }
}

Product::handleFormData();