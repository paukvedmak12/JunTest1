<?php
require_once __DIR__ . '/../database/Database.php';
require_once 'DvdProduct.php';
require_once 'BookProduct.php';
require_once 'FurnitureProduct.php';

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $productType;

    public function __construct($sku, $name, $price, $productType)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
    }

    abstract public function save($db);
    abstract public function displayAttributes();

    public static function deleteByIds($deleteIds)
    {
        $db = new Database();

        if (!empty($deleteIds)) {
            $placeholders = implode(',', array_fill(0, count($deleteIds), '?'));

            $stmt = $db->prepare("DELETE FROM products WHERE id IN ($placeholders)");

            if ($stmt) {

                $types = str_repeat('i', count($deleteIds));
                $stmt->bind_param($types, ...$deleteIds);

                if ($stmt->execute()) {
                    $stmt->close();
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function createProductFromRow($row)
    {
        $productClassName = ucfirst(strtolower($row['product_type'])) . 'Product';
    
        if (class_exists($productClassName)) {
       
            $height = $row['height'] ?? null;
            $width = $row['width'] ?? null;
            $length = $row['length'] ?? null;
    
            return new $productClassName(
                $row['sku'],
                $row['name'],
                $row['price'],
                $row['product_type'],
                $row['size_mb'],  
                $row['weight_kg'], 
                $height,
                $width,
                $length
                
                 
            );
        } else {
            return null;
        }
    }
    
    public static function handleFormData() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $_POST['sku'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $productType = $_POST['productType'];
            $postData = $_POST;
    
            $db = new Database();
    
    
            $product = ProductFactory::createProduct($sku, $name, $price, $productType, $postData);
    
    
            $result = $product->save($db);
            if ($result === true) {
                header("Location: /index.php");
                exit();
            }
        }
    }

    public static function displayProductsFromDatabase()
    {
        $db = new Database();
        $result = $db->query("SELECT id, sku, name, price, product_type, size_mb,  weight_kg, height, width, length FROM products");

        $output = '<div class="product-container-row">';

        while ($row = $result->fetch_assoc()) {
            $product = Product::createProductFromRow($row);


            $output .= '<div class="product">';


            $output .= '<input type="checkbox" name="deleteIds[]" class="delete-checkbox" value="' . $row['id'] . '">';
            $output .= '<p>SKU: ' . $row['sku'] . '</p>';
            $output .= '<p>Name: ' . $row['name'] . '</p>';
            $output .= '<p>Price: $' . $row['price'] . '</p>';

            if ($product !== null) {
                $output .= '<p>' . $product->displayAttributes() . '</p>';
            }

            $output .= '</div>';
        }

        $output .= '</div>';

        echo $output;
    }

    
}
