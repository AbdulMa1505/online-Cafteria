# Online Cafeteria Project

Welcome to the Online Cafeteria! This project is a feature-rich, fully-responsive online ordering system for a cafeteria. Built with Bootstrap, jQuery, AJAX, and vanilla PHP, it provides an intuitive front-end experience and a powerful backend, including an admin dashboard for managing orders, menu items, and user accounts.

## 📋 Table of Contents

- [About the Project](#about-the-project)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Screenshots](#screenshots)
- [Installation](#installation)
- [Usage](#usage)
- [Folder Structure](#folder-structure)
- [Contributing](#contributing)
- [License](#license)

---

## About the Project

The Online Cafeteria project is designed for cafeteria managers and customers alike, providing a seamless experience for ordering and managing food items. The project includes a front-end where users can browse the menu, add items to their cart, and place orders. The back-end (admin dashboard) allows cafeteria managers to manage menu items, view orders, and track user activity.

## Features

### User Interface
- **Responsive Layout**: Built with Bootstrap to look great on all devices.
- **AJAX-driven Interactions**: Smooth, instant interactions for cart updates, order placements, and more.
- **Animations**: Subtle animations for a modern, interactive feel.

### User Functionality
- **Browse Menu**: Users can view the cafeteria’s menu, complete with images, prices, and descriptions.
- **Add to Cart**: Add items to a cart, update quantities, and remove items as desired.
- **Place Order**: Checkout process that captures order details and stores them in the database.
- **Account Management**: User registration and login with password encryption.
- **Single Product View**: Users can view detailed information about a specific product, including image, description, price, and size options
- **Related Products**: When viewing a specific product, users are shown related products based on type, enhancing the shopping experience.

### Admin Dashboard
- **Order Management**: View and update orders placed by users.
- **Menu Management**: Add, edit, or remove items from the cafeteria menu.
- **User Management**: View and manage user accounts.
- **Reports**: Generate reports on daily orders, revenue, and other key metrics.

## Tech Stack

### Frontend
- **HTML, CSS, Bootstrap**: Responsive design for a clean, modern look.
- **JavaScript, jQuery**: For dynamic content and AJAX-powered interactions.
- **AJAX**: Ensures a smooth user experience by handling requests in the background.
- **Animations**: CSS animations to enhance user experience.

### Backend
- **PHP**: Vanilla PHP for server-side logic, user authentication, and database operations.
- **MySQL**: Database to store user information, orders, menu items, and more.


## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/AbdulMa1505/online-cafeteria.git
    ```

2. **Navigate to the project directory**:
    ```bash
    cd online-cafeteria
    ```

3. **Setup Database**:
   - Import the provided SQL file (e.g., `database.sql`) to set up the database schema and tables.

4. **Configure Database Connection**:
   - Open `includes/connect.php` and update the database credentials to match your setup:
     ```php
     $host = 'localhost';
     $user = 'your_db_username';
     $password = 'your_db_password';
     $dbname = 'your_db_name';
     ```

5. **Run the Application**:
   - Start your server (e.g., using XAMPP or WAMP) and navigate to `http://localhost/online-cafeteria`.

## Usage

1. **User Account**:
   - Register as a new user or log in with existing credentials to start ordering.
   - Browse the menu, add items to the cart, and proceed to checkout.

2. **Admin Account**:
   - Log in to access the admin dashboard.
   - Manage orders, menu items, and user accounts from the dashboard interface.

3. **AJAX Functionality**:
   - Enjoy smooth interactions throughout the site, from adding items to the cart to managing the checkout process without full page reloads.
4 New Folder - product/
single.php: Page displaying details for a single product, including its name, description, price, image, and other details.
## Contributing
Contributions are welcome! Please open a pull request or issue to discuss your changes
## Folder Structure

```plaintext
online-cafeteria/
├── Coffeeshop/              # Main folder
├── auth/                    # User authentication pages (login, register, logout)
├── bookings/                # User bookings pages (booking)
├── includes/                # Header, footer, and other reusable components
├── css/                     # Custom styles and Bootstrap files
├── fonts/                   # Custom fonts 
├── js/                      # JavaScript, jQuery, and AJAX files
├── scss/                    # Custom scss and Bootstrap files
├── admin/                   # Admin dashboard files
├── images/                  # Images used in the project
├── index.php                # Homepage
├── cart.php                 # Shopping cart page
├── checkout.php             # Order checkout page
├── menu.php                 # Menu listing page
├── services.php             # Services listing page
├── about.php                # About page
├── contact.php              # Contact form page
├── product/                 # New folder containing single product view and related products
│   ├── single.php           # Single product view
└── README.md                # Project documentation
