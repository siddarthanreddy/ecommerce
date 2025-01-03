
### Let’s Start with the Database Setup

Here’s the step-by-step process to get the database ready:

#### Step 1: Creating the Database
1. Open **phpMyAdmin** (or any database management tool).
2. Create a new database named `ecommerce_db`.
3. Run the following SQL query to create the necessary tables:


### **SQL Commands and Table Explanation**

#### 1. **Cart Table**
```sql
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

- **Purpose**: Tracks products added to a user's cart.
- **Columns**:
  - `id`: Unique identifier for each cart entry.
  - `user_id`: References the user who added the product.
  - `product_id`: References the product added to the cart.
  - `quantity`: Specifies the number of units.
  - `created_at`: Timestamp when the entry was created.
  - `updated_at`: Timestamp updated whenever the entry is modified.

---

#### 2. **Products Table**
```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

- **Purpose**: Stores product details.
- **Columns**:
  - `id`: Unique identifier for each product.
  - `name`: Name of the product.
  - `price`: Cost of the product.
  - `description`: Details about the product.
  - `image`: Path to the product image.
  - `created_at`: Timestamp when the product was added.

---

#### 3. **Users Table**
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('user', 'admin') DEFAULT 'user'
);
```

- **Purpose**: Manages user information.
- **Columns**:
  - `id`: Unique identifier for each user.
  - `username`: User's display name.
  - `email`: User's email address (must be unique).
  - `password`: Hashed password for security.
  - `created_at`: Timestamp when the user registered.
  - `role`: Defines the user's role (`user` or `admin`).

---

#### Step 2: Setting Up `db.php`
1. Create a folder named `includes` in your project directory.
2. Inside this folder, create a file named `db.php`.
3. Add the following code:

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

**Explanation**:
- This file establishes a connection to the database using MySQLi.
- If the connection fails, an error message is displayed.

---

#### Step 3: Testing the Database Connection
1. Create a new file named `test_db.php` in the root folder.
2. Add the following code to test the connection:

```php
<?php
include 'includes/db.php';

if ($conn) {
    echo "Database connected successfully!";
} else {
    echo "Failed to connect to the database.";
}
?>
```

3. Access `http://localhost/ecommerce/test_db.php` in your browser.
4. Ensure the message **"Database connected successfully!"** is displayed.

---

### Next Steps:
Once the database is set up:
1. Move to the **Registration Page (`register.php`)** so users can create accounts.
2. Build the **Login Page (`login.php`)** to authenticate users.
3. Proceed to dynamic pages like `index.php`.
