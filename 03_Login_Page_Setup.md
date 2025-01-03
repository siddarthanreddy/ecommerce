### Step-by-Step Guide to Build the Login Page (`login.php`)

The **Login Page** allows users to access their accounts. Here's how to build it:

---

### **Step 1: Create the `login.php` File**
1. Inside the `pages` folder, create a file named `login.php`.

---

### **Step 2: Structure the HTML Form**
Add the following code to create the login form:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>
```

- **Explanation**:
  - The form uses the `POST` method for secure data submission.
  - Includes fields for `email` and `password`.
  - A link to the **Register** page is provided for new users.

---

### **Step 3: Add PHP Logic for Login**
Below the HTML, add PHP code to handle login requests:

```php
<?php
session_start();
include '../includes/db.php'; // Include the database connection

if (isset($_POST['login'])) {
    // Capture form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user details in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] === 'admin') {
                header('Location: ../admin/dashboard.php');
            } else {
                header('Location: ../index.php');
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.');</script>";
    }
}
?>
```

- **Explanation**:
  - `password_verify()` is used to compare the entered password with the hashed password in the database.
  - A session is started to store the user’s details after successful login.
  - Redirects the user to the appropriate page based on their role (`admin` or `user`).

---

### **Step 4: Add Styling**
In your `css/style.css` file, the styles for the login page are already covered if you used the same layout as the registration page.

---

### **Step 5: Test the Login Page**
1. Start your local server.
2. Navigate to `http://localhost/ecommerce/pages/login.php`.
3. Use the credentials of a registered user to log in.
4. Test for both `user` and `admin` roles:
   - Admins should be redirected to the admin dashboard.
   - Regular users should be redirected to the homepage.

---

### Next Steps:
Once the login page is complete:
1. Build the **Admin Dashboard (`dashboard.php`)**.
2. Implement a **Logout System** to end the session when users log out.

