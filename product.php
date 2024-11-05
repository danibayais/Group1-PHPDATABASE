<?php
// product.php: View product details

session_start();
include('includes/db.php');

$product_id = isset($_GET['id']) ? $_GET['id'] : 0;

$sql = "SELECT * FROM products WHERE id = '$product_id'";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <p><?php echo $product['description']; ?></p>
    <p>Price: $<?php echo $product['price']; ?></p>
    <p>Size: <?php echo $product['size']; ?></p>
    <p>Color: <?php echo $product['color']; ?></p>
    <a href="cart.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
</body>
</html>
