# Laravel E-Commerce Application

A powerful, full-featured e-commerce platform built with Laravel, Filament PHP, and Tailwind CSS. It provides a seamless shopping experience on the frontend and a robust, intuitive administrative dashboard on the backend.

## 🌟 Live Demo

Experience the application in action:
**[View Live Demo](https://demo-ecommerce.free.laravel.cloud)**

---

## ✨ Key Features

### 🛒 Frontend (Customer Facing)

- **Modern User Interface**: Fully responsive, clean, and intuitive design using Tailwind CSS and Alpine.js.
- **Product Catalog**: Browse and search products, view details, and filter by categories.
- **Shopping Cart & Checkout**: Seamless cart management and a smooth, multi-step checkout process.
- **Payment Integration**: Secure, robust payment gateway integration via Midtrans for various payment methods.
- **Order Tracking**: Customers can track their placed orders from their dashboard.

### 🛠️ Backend (Admin Panel - Powered by Filament PHP)

- **Dashboard Analytics**: Comprehensive statistics, sales charts, and overview metrics.
- **Product & Inventory Management**: Add, edit, delete products, and manage stock levels.
- **Category Management**: Organize products using dynamic categories.
- **Order Management**: Process incoming orders, update statuses, and fulfill customer requests.
- **Role-Based Access Control**: Secure permission and role management for staff accounts using Spatie Permission.
- **Dynamic Banners**: Manage promotional banners for the frontend from the admin dashboard.

---

## 💻 Technology Stack

- **Framework**: [Laravel 12](https://laravel.com/)
- **Admin Panel**: [Filament v3](https://filamentphp.com/)
- **Frontend Styling**: [Tailwind CSS](https://tailwindcss.com/)
- **JavaScript**: [Alpine.js](https://alpinejs.dev/) & Vanilla JS
- **Payment Gateway**: [Midtrans](https://midtrans.com/)
- **Roles & Permissions**: [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) & Filament Shield

---

## 🚀 Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

Ensure you have the following installed on your local machine:

- PHP >= 8.2
- Composer
- Node.js & npm
- A relational database (MySQL)

### Installation

1. **Clone the repository:**

    ```bash
    git clone <repository-url>
    cd ecommerce-sayur
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies:**

    ```bash
    npm install
    npm run build
    ```

4. **Set up the environment file:**

    ```bash
    cp .env.example .env
    ```

    _Note: Make sure to update your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) and Midtrans credentials in the `.env` file._

5. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

6. **Run database migrations and seeders:**

    ```bash
    php artisan migrate --seed
    ```

    _(The seeders will populate your database with dummy products, categories, and setup default roles/admin accounts)._

7. **Link the storage directory:**
   Ensure public images are accessible.

    ```bash
    php artisan storage:link
    ```

8. **Start the local development server:**
    ```bash
    php artisan serve
    ```

You can now visit `http://localhost:8000` to see the application!

---

## 🛡️ Admin Access

By default, after running setup and seeders, you can access the admin panel at `/admin`.

- **Super Admin Email**: `admin@sayur.com` (Check your Database Seeder for the exact credentials)
- **Password**: `password` (or as defined in your system)

_You can update the credentials using Filament's profile section after your first login._

---

## 📜 License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
