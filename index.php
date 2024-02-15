<?php
require_once 'classes/Product.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts/scripts.js"></script>
    <link rel="stylesheet" href="styles/styles.css">
    <title>Product List</title>
</head>
<body>

<div class="header-container">
    <div id="header">
        <h1>Product List</h1>
        <div id="buttons">
            <button onclick="location.href='add_product.php'">Add</button>
            <button type="button" onclick="massDelete()">Mass Delete</button>
        </div>
    </div>
</div>

<div class="product-container">
    <form id="massDeleteForm" action="delete_products.php" method="post">
        <div id="product_list" >
        <?php echo Product::displayProductsFromDatabase(); ?>
        </div>
        <input type="hidden" name="deleteIds" id="deleteIds">
    </form>
</div>

</body>
</html>
