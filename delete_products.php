<?php
require_once 'classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteIds']) && !empty($_POST['deleteIds'])) {
        $deleteIds = explode(',', $_POST['deleteIds']); 
        
        if (is_array($deleteIds) && !empty($deleteIds)) {
            if (Product::deleteByIds($deleteIds)) {
                header('Location: index.php');
                exit();
            } else {
                echo "Failed to delete products.";
            }
        } else {
            echo "No products selected for deletion.";
        }
    } else {
        header('Location: index.php');
        exit();
    }
}