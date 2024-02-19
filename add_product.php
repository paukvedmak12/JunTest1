<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    <script src="scripts/scripts.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <title>Add Product</title>
</head>
<body>

<form id="product_form" action="functions/create_product.php" method="post" onsubmit="return false;">
   <div class="header-container">
        <div id="header">
            <h1>Add Product</h1>
            <div id="buttons">
                <button type="submit">Save</button>
                <button type="button" class="close-button" onclick="window.location.href='index.php'">Close</button>
            </div>
        </div>
    </div>

    <label for="sku">SKU:</label>
    <input type="text" id="sku" name="sku" required><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" required><br>

    <label for="productType">Product Type:</label>
    <select id="productType" name="productType" onchange="showProductTypeFields()">
        <option value="" style="display:none;">Select Product Type</option>
        <option value="dvd">DVD</option>
        <option value="book">Book</option>
        <option value="furniture">Furniture</option>
    </select>
    <input type="hidden" id="selectedProductType" name="selectedProductType">

    <div id="sizeField" style="display: none;">
        <label for="size">Size (MB):</label>
        <input type="number" id="size" name="size">
    </div>

    <div id="weightField" style="display: none;">
        <label for="weight">Weight (Kg):</label>
        <input type="number" id="weight" name="weight">
    </div>

    <div id="dimensionsField" style="display: none;">
        <label for="height">Height:</label>
        <input type="number" id="height" name="height"><br>

        <label for="width">Width:</label>
        <input type="number" id="width" name="width"><br>

        <label for="length">Length:</label>
        <input type="number" id="length" name="length"><br>
    </div>

    <?php
    if (!empty($error_message)) {
        echo '<p>' . htmlspecialchars($error_message) . '</p>';
    }
    ?>

</form>

</body>
</html>