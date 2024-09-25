# Laravel Project Setup

## Overview

This task involves generating dynamic columns for each month between the minimum first_payment_date and maximum last_payment_date found in the loan_details table. The new columns will reflect the monthly payment status for each client based on the existing data, allowing for enhanced analysis of loan payment trends over time.

## Prerequisites

1. **PHP** (version 8.0 or higher)
2. **Composer** (for managing PHP dependencies)
3. **MySQL** (or any other compatible database)
4. **Node.js** (for running the development server)
5. **npm** (for managing JavaScript dependencies)

## Setup Instructions

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/shailendradigarse/emiCalculator.git
cd emiCalculator
```
### 2. Install PHP Dependencies

Install the PHP dependencies using Composer:

```bash
composer install
```

### Configure Environment Variables

1. **Create the .env File**:

Copy the example environment file to create a new .env file:

```bash
cp .env.example .env
```

2 **Set Up Database Configuration**:

Open the .env file and configure your database settings:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Make sure to replace your_database_name, your_database_username, and your_database_password with your actual database credentials.

4. **Generate Application Key**:
Generate a new application key for the Laravel project:

```bash
php artisan key:generate
```
5. **Run Migrations**:
Run the database migrations to set up the necessary tables:

```bash
php artisan migrate
```
6. **Install Node.js Dependencies**:

Install the Node.js dependencies:

```bash
npm install
```
7. **Run Development Server**:
Start the development server to serve the application:

```bash
npm run dev
```
8. **Start PHP Server**:
Open a new terminal and start the PHP development server:

```bash
php artisan serve
```
The application will be accessible at http://127.0.0.1:8000 (or another port specified in the output).

9. **Run Seeders**:
To populate the database with initial data, run the following commands:

```bash
php artisan db:seed --class=UserSeeder
```

```bash
php artisan db:seed --class=LoanDetailsSeeder
```

## Summary
Cloned the repository and installed dependencies.
Configured the .env file for database settings.
Generated application key and ran migrations.
Installed Node.js dependencies and started development server.
Ran the PHP server to access the application.
Ran the seeders for user and loan details.

