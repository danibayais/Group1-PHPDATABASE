<?php
// Remove session_start() here since it's already called in header.php
include('includes/db.php');

// Basic filtering for products (based on size, color)
$filter_size = isset($_GET['size']) ? $_GET['size'] : '';
$filter_color = isset($_GET['color']) ? $_GET['color'] : '';

$sql = "SELECT * FROM products WHERE 1";

if ($filter_size) {
    $sql .= " AND size = '$filter_size'";
}

if ($filter_color) {
    $sql .= " AND color = '$filter_color'";
}

$result = mysqli_query($conn, $sql);
?>

<!-- Include header.php -->
<?php include('includes/header.php'); ?>

<h1>Welcome to Our Shoe Store</h1>

<!-- Filter Section -->
<div class="filter-section">
    <form method="GET" action="index.php">
        <select name="size">
            <option value="">Select Size</option>
            <option value="8" <?php echo ($filter_size == '8' ? 'selected' : ''); ?>>8</option>
            <option value="9" <?php echo ($filter_size == '9' ? 'selected' : ''); ?>>9</option>
            <option value="10" <?php echo ($filter_size == '10' ? 'selected' : ''); ?>>10</option>
        </select>
        <select name="color">
            <option value="">Select Color</option>
            <option value="Red" <?php echo ($filter_color == 'Red' ? 'selected' : ''); ?>>Red</option>
            <option value="Black" <?php echo ($filter_color == 'Black' ? 'selected' : ''); ?>>Black</option>
            <option value="White" <?php echo ($filter_color == 'White' ? 'selected' : ''); ?>>White</option>
        </select>
        <button type="submit">Filter</button>
    </form>
</div>

<!-- Products Section -->
<div class="products">
    <?php while ($product = mysqli_fetch_assoc($result)) { ?>
        <div class="product">
            <!-- Display the product image -->
            <img src="img/<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>" />
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['description']; ?></p>
            <p class="price">₱<?php echo $product['price']; ?></p>
            <a href="product.php?id=<?php echo $product['id']; ?>">View Product</a>
        </div>
    <?php } ?>
</div>

<!-- Include footer.php -->
<?php include('includes/footer.php'); ?>

</body>
</html>
