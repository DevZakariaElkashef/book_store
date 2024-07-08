Online Bookstore for University Textbooks
Welcome to our comprehensive online bookstore, designed to facilitate the sale of university textbooks. This repository contains the codebase for both the user-facing website and the admin control panel. The platform allows users to browse and purchase books online, while the admin panel offers robust management capabilities for administrators. Below, you'll find a detailed breakdown of the features and functionalities of this project.

Project Overview
Our online bookstore caters to university students looking to buy textbooks, whether new or used. The platform is composed of two main components:

User Website: A feature-rich e-commerce site where students can register, browse, purchase books, and manage their orders.
Admin Control Panel: A backend system for administrators to manage users, content, books, and orders.
User Website Features
Pages and Functionalities
Login: Users can log in with their email and password.
Register: New users can create an account by providing their name, phone number, email, and password, and accepting the terms and conditions.
Home: The landing page features a slider with promotional images, icons for universities and used books, and sections for the latest and most popular books.
Universities: Users can browse books by selecting their university and college.
Books: Comprehensive listings of books, including details like price, discounts, and the ability to add to cart or wishlist.
Product Details: Detailed view of a selected book, including images, specifications, and user reviews.
Shopping Cart: View and manage books added to the cart, adjust quantities, and proceed to checkout.
Checkout: Users fill in their shipping details and choose a payment method (credit card or bank transfer) to complete the purchase.
Account Management: Users can update their personal details, view order history, track order status, and manage their wishlist.
Notifications: Users receive updates on their order status and other important information.
About Us: Information about the bookstore.
Terms and Conditions: Detailed terms and conditions for using the bookstore.
Contact Us: A form for users to reach out to the admin team with any inquiries or issues.
User Data Handling
Registration and Login: Secure user registration and login processes.
Order Management: Users can view and manage their past orders, including tracking order status and canceling orders if needed.
Wishlist: Users can add books to their wishlist for future purchases.
Notifications: Timely updates on order status and other relevant information.
Admin Control Panel Features
Management Capabilities
User Management: Add, edit, and delete users (employees) with specific roles and permissions.
Content Management: Update static pages such as terms and conditions.
University Management: Add, edit, and delete universities and their respective colleges.
Book Management: Add, edit, and delete books, including details like university, college, and professor.
Order Management: Review and process customer orders, and track sales performance over different time periods (day, week, month).
Sales Analytics: View total sales data filtered by specific time periods.
Getting Started
Prerequisites
PHP
Laravel
MySQL
Composer
Node.js
Installation
Clone the repository:
bash
Copy code
git clone https://github.com/yourusername/university-bookstore.git
Navigate to the project directory:
bash
Copy code
cd university-bookstore
Install dependencies:
bash
Copy code
composer install
npm install
Set up the environment variables:
bash
Copy code
cp .env.example .env
Generate the application key:
bash
Copy code
php artisan key:generate
Run migrations and seed the database:
bash
Copy code
php artisan migrate --seed
Running the Application
Start the development server:

bash
Copy code
php artisan serve
Compile the frontend assets:

bash
Copy code
npm run dev
Contributing
We welcome contributions to improve the platform. Please fork the repository and submit pull requests with detailed descriptions of your changes.

License
This project is licensed under the MIT License. See the LICENSE file for more details.
