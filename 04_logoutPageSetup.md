### Step-by-Step Guide to Build the Logout Page (`logout.php`)

The **Logout Page** ends the user's session and redirects them to the login page. This is a simple yet crucial feature for managing user authentication.

---

### **Step 1: Create the `logout.php` File**
1. Inside the `pages` folder, create a file named `logout.php`.

---

### **Step 2: Add PHP Logic to Destroy the Session**
Add the following code to handle the logout functionality:

```php
<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header('Location: login.php');
exit();
?>
```

- **Explanation**:
  - `session_start()`: Starts the session to access session variables.
  - `session_unset()`: Frees all session variables.
  - `session_destroy()`: Destroys the session.
  - `header('Location: login.php')`: Redirects the user to the login page after logging out.

---

### **Step 3: Add a Logout Link to Other Pages**
To ensure users can log out from anywhere, add a logout link to the navigation bar of all user-facing pages, such as `index.php`:

```html
<li><a href="pages/logout.php">Logout</a></li>
```

---

### **Step 4: Test the Logout Page**
1. Log in as a user.
2. Navigate to `http://localhost/ecommerce/pages/logout.php`.
3. Verify the following:
   - The session is destroyed (e.g., you are logged out).
   - You are redirected to the login page.

---

### **Next Steps: User Pages Overview**
Now that the logout functionality is implemented, the core user-facing pages are complete:
- **Register (`register.php`)**
- **Login (`login.php`)**
- **Logout (`logout.php`)**
- **Index/Home Page (`index.php`)** (if not done yet)

Lets Move To:
1. The **Home Page (`index.php`)** for product display.
