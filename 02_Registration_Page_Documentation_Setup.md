### Step-by-Step Guide to Build the Registration Page (`register.php`)

The **Registration Page** allows new users to create an account. Here’s how to build it:

---

### **Step 1: Create the `register.php` File**
1. Inside the `pages` folder, create a file named `register.php`.

---

### **Step 2: Structure the HTML Form**
Add the following code to create the registration form:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>
```

- **Explanation**:
  - The form uses the `POST` method for secure data submission.
  - Fields include `username`, `email`, and `password`.
  - The `name="register"` attribute is used to identify when the form is submitted.

---

### **Step 3: Add PHP Logic for Registration**
Below the HTML, add PHP code to handle form submissions:

```php
<?php
include '../includes/db.php'; // Include the database connection

if (isset($_POST['register'])) {
    // Capture form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please try another email.');</script>";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>
```

- **Explanation**:
  - Use `mysqli_real_escape_string` to sanitize user input and prevent SQL injection.
  - Use `password_hash()` for secure password storage.
  - Check if the email already exists to prevent duplicate accounts.
  - Insert the new user into the `users` table upon successful validation.

---

### **Step 4: Add CSS for Styling**
In your `css/style.css` file, add some basic styling for the form:

```css
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    border-radius: 5px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 0;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 10px;
    background: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}
```

---

### **Step 5: Test the Registration Page**
1. Start your local server.
2. Navigate to `http://localhost/ecommerce/pages/register.php`.
3. Fill out the form and submit it.
4. Check the database to confirm the new user is registered.

---

### Next Steps:
Once the registration page is complete:
1. Build the **Login Page (`login.php`)**.
2. Implement session management for logged-in users.
