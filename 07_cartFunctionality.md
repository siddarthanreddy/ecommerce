

### **Step 1: Modify the Add to Cart Button**
The `Add to Cart` button may already interact with an existing functionality. Typically, this involves:

1. A form for submitting product details (e.g., product ID and quantity).
2. Redirecting the data to an existing script or function that updates the database.

For the button, ensure it aligns with the existing functionality:

```php
<form method="POST" action="pages/cart.php">
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit">Add to Cart</button>
</form>
```

- If `cart.php` already processes cart updates, this action will redirect the request there.
- Adjust the `action` attribute to align with the current system.

---

### **Step 2: Ensure `cart.php` Processes the Data**
Open the existing `cart.php` file from the zip and verify whether it:
1. Accepts POST requests for `product_id` and `quantity`.
2. Updates the `cart` table in the database.

The existing `cart.php` might look like this:

```php
<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    $userId = $_SESSION['user_id'] ?? 0;

    if ($userId === 0) {
        echo "<script>alert('Please log in to add items to your cart.'); window.location.href='login.php';</script>";
        exit();
    }

    // Check if the item is already in the cart
    $checkCart = "SELECT * FROM cart WHERE user_id = $userId AND product_id = $productId";
    $result = $conn->query($checkCart);

    if ($result->num_rows > 0) {
        // Update the quantity
        $updateCart = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $userId AND product_id = $productId";
        $conn->query($updateCart);
    } else {
        // Insert the item into the cart
        $addCart = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";
        $conn->query($addCart);
    }

    echo "<script>alert('Product added to cart!'); window.location.href='../index.php';</script>";
}
?>
```

- Adjust this code to match the behavior you observe in the current `cart.php`.

---

### **Step 3: Test the Integration**
1. Open the `index.php` and click the "Add to Cart" button for a product.
2. Confirm that the product appears in the database’s `cart` table.
3. Open the `cart.php` page to verify the cart display.

---

If the `cart.php` or `index.php` functionality is incomplete or unclear in the zip, let me know, and we can analyze the file contents to align the workflow exactly as it was designed!
