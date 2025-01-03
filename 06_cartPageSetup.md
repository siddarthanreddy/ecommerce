### Step-by-Step Guide to Build the Cart Page (`cart.php`)

The **Cart Page** allows users to view and manage products they have added to their cart. Here’s how to create it:

---

### **Step 1: Create the `cart.php` File**
1. Inside the `pages` folder, create a file named `cart.php`.

---

### **Step 2: HTML Structure of the Cart Page**
Add the following code to set up the cart page:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - E-Commerce</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="cart.php">Cart</a></li>
        </ul>
    </nav>

    <!-- Cart Container -->
    <div class="cart-container">
        <h2>Your Cart</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Cart items will be dynamically displayed here -->
            </tbody>
        </table>
        <div class="cart-summary">
            <h3>Cart Summary</h3>
            <p>Total: $<span id="cart-total">0</span></p>
        </div>
    </div>
</body>
</html>
```

**Explanation:**
1. The `<table>` structure provides columns for product details, quantity, and total price.
2. The `<div class="cart-summary">` shows the total price of the items in the cart.

---

### **Step 3: Fetch and Display Cart Items**
Add the following PHP code inside the `<tbody>` tag to dynamically display cart items:

```php
<?php
session_start();
include '../includes/db.php';

// Fetch cart items for the logged-in user
$userId = $_SESSION['user_id'] ?? 0;
$sql = "SELECT cart.id AS cart_id, products.name, products.price, cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cartTotal = 0;
    while ($row = $result->fetch_assoc()) {
        $totalPrice = $row['price'] * $row['quantity'];
        $cartTotal += $totalPrice;
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>$" . $row['price'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>$" . $totalPrice . "</td>";
        echo "<td><a href='remove_cart_item.php?id=" . $row['cart_id'] . "'>Remove</a></td>";
        echo "</tr>";
    }
    echo "<script>document.getElementById('cart-total').innerText = $cartTotal;</script>";
} else {
    echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
}
?>
```

**Explanation:**
1. Fetches cart items for the logged-in user from the `cart` table.
2. Calculates the total price for each product and sums up the cart total.
3. Displays each cart item in a table row with a "Remove" link.

---

### **Step 4: Remove Items from the Cart**
1. Create a new file named `remove_cart_item.php` in the `pages` folder.
2. Add the following code to handle item removal:

```php
<?php
session_start();
include '../includes/db.php';

if (isset($_GET['id'])) {
    $cartId = intval($_GET['id']);
    $sql = "DELETE FROM cart WHERE id = $cartId";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Item removed from cart.'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Failed to remove item.'); window.location.href='cart.php';</script>";
    }
}
?>
```

**Explanation:**
1. Deletes the item with the given `id` from the `cart` table.
2. Redirects back to the cart page with a success or failure message.

---

### **Step 5: Add Styling for the Cart Page**
Add the following CSS to `css/style.css`:

```css
.cart-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #f9f9f9;
}

.cart-container table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.cart-container table th,
.cart-container table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.cart-container .cart-summary {
    text-align: right;
}

.cart-container .cart-summary p {
    font-size: 18px;
    font-weight: bold;
}
```

---

### **Step 6: Test the Cart Page**
1. Log in as a user and add some items to the cart table manually or through a form.
2. Open `http://localhost/ecommerce/pages/cart.php` in your browser.
3. Verify that:
   - Cart items are displayed with correct details.
   - The total price updates dynamically.
   - Items can be removed using the "Remove" link.

---

### Next Steps:
1. Ensure the "Add to Cart" button on the `index.php` page inserts products into the `cart` table for logged-in users.
2. Test the full workflow of adding, viewing, and removing items from the cart.
