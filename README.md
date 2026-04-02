# Laravel POS System

## Overview

The Laravel POS (Point of Sale) System is a complete retail sales application designed to simplify billing, inventory control, and customer management. Developed using **Laravel** and **Blade templates**, this system follows a modular structure aligned with SOLID and DRY principles to ensure scalability, readability, and maintainability.

This POS system is suitable for retail shops, restaurants, pharmacies, and small to medium businesses requiring a fast and efficient sales interface.

---

## Installation

### 1. Prerequisites

Ensure your environment meets the following requirements:

- PHP >= 8.2  
- php-curl  
- php-xml  
- php-mysql  
- php-mbstring  
- Laravel >= 10.0  
- MySQL  
- Composer >= 2.0  

---

### 2. Clone the Repository

```bash
    git clone https://github.com/auraslit/AuraPos.git
```

### 3. Install Dependencies:
    ```Bash
    cd e-commerce-master-laravel
    composer install
    ```

### 4. **Configuration:**

    - Database Configuration:

      Copy `env.example` file and Edit the `.env` file to configure your database connection details (`host, database name, username, password`).
      Consider using a secure environment variable management solution for production environments.

    - Application Configuration:

      Review the **config** directory for any additional application-specific configuration files.

### 5. **Database Migrations:**

   Run the following command to create the database tables:**
    ```bash
    php artisan migrate
    ```
### 6. **Run the seeder:**

   Run the following command to seed the database with sample data:
    ```bash
    php artisan db:seed
    ```
### 7. **Set the APP_ENV:**

    Edit the `.env` to set `APP_ENV`.
    For the production server, set APP_ENV=production
    For the staging server, set APP_ENV=staging
    For local or development server, set APP_ENV=local

### 8. **Start the Application:**

   Run the following command to start the application:
    ```bash
    php artisan serve --port=8000
    ```
   The application will be accessible at `http://localhost:8000`.
    ```

### Code Structure
- Have to strictly follow SOLID and DRY principles.
- Method should not have more than 15 lines of code with valid exception. Comment and line break will not be counted.
- Business logic will be on service class. There will be multiple services under namespaces if required


