### **Updated Documentation: `00_Overview.md`**

---

### **Project Overview**
This project involves building an e-commerce website with two user roles: **Admin** and **Customer**. The primary functionalities include user management, product display, cart operations, and admin-specific controls like adding and managing products.

---

### **Features**
1. **Customer Features**:
   - **Register**: Allows new customers to sign up.
   - **Login/Logout**: Authenticate customers securely.
   - **View Products**: Browse available products on the homepage.
   - **Add to Cart**: Add products to a shopping cart.
   - **View Cart**: Manage cart items and proceed to checkout (optional).

2. **Admin Features**:
   - **Login/Logout**: Secure admin access to the control panel.
   - **Dashboard**: Centralized admin control interface.
   - **Manage Products**: View, edit, and delete products.
   - **Add Products**: Add new products with name, price, description, and image.

---

### **File Structure**
- **Root Directory**:
  - `index.php`: Homepage for viewing products.
- **Admin Directory** (`admin/`):
  - `login.php`: Admin login page.
  - `logout.php`: Ends admin session.
  - `dashboard.php`: Admin control panel.
  - `add_product.php`: Add new products.
  - `manage_products.php`: View, edit, or delete products.
- **Customer Directory** (`pages/`):
  - `register.php`: Customer registration.
  - `login.php`: Customer login.
  - `logout.php`: Ends customer session.
  - `cart.php`: Displays and manages cart items.
- **Includes Directory** (`includes/`):
  - `db.php`: Database connection file.
- **Assets**:
  - `css/style.css`: Styling for the entire project.
  - `images/`: Product images and assets.

---

### **Databases Used**

1. **Users Table**:
   - Stores information for both customers and administrators.
   - Fields:
     - `id`: Unique identifier for each user.
     - `username`: Name of the user.
     - `email`: Email address (unique).
     - `password`: Encrypted password.
     - `role`: Specifies if the user is a `user` (customer) or `admin`.
     - `created_at`: Timestamp of when the user was added.

2. **Products Table**:
   - Contains details of all products available in the store.
   - Fields:
     - `id`: Unique identifier for each product.
     - `name`: Name of the product.
     - `price`: Price of the product.
     - `description`: Brief description of the product.
     - `image`: Name of the image file for the product.
     - `created_at`: Timestamp of when the product was added.

3. **Cart Table**:
   - Stores items added to the cart by customers.
   - Fields:
     - `id`: Unique identifier for each cart entry.
     - `user_id`: References the `id` of the user who owns the cart.
     - `product_id`: References the `id` of the product in the cart.
     - `quantity`: Number of units of the product added to the cart.
     - `created_at`: Timestamp of when the item was added to the cart.

---

### **How to Set Up**
1. **Database Setup**:
   - Create a database named `ecommerce`.
   - Use a database management tool like phpMyAdmin to create the required tables (`users`, `products`, and `cart`).

2. **File Placement**:
   - Place the project files in your web server’s root directory (e.g., `htdocs` for XAMPP).

3. **Run the Application**:
   - Start your web server and navigate to `http://localhost/ecommerce/`.

---

### **Next Steps**
For detailed implementation of each feature, refer to the following:
- `01_databaseSetup.md`: Database setup instructions.
- `02_registrationPageSetup.md`: Customer registration.
- `03_loginPageSetup.md`: Customer login.
- `04_logoutPageSetup.md`: Customer logout.
- `05_indexPageSetup.md`: Homepage for products.
- `06_cartPageSetup.md`: Cart functionality.
- **Admin Pages**: Documentation for admin functionalities.
