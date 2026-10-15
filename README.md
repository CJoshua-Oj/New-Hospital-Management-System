# New Hospital Management System

Hospital Management System for managing patients, doctors, departments, appointments, admissions, clinical visits, prescriptions, billing, payments, and reports using PHP, MySQL, HTML, CSS, and JavaScript.

## Requirements
- PHP 8.3+
- MySQL 5.7+/MariaDB
- Apache (XAMPP/WAMP works)

## Setup
1. Copy the project into `htdocs`.
2. Create a MySQL database named `hmsss`.
3. Import `database/hms.sql`.
4. Edit `include/config.php` if your database credentials differ from the defaults.
5. Open the `hospital/` folder in your browser.

The original legacy password records are still accepted for migration; after a successful login they are automatically upgraded to PHP password hashes. New and reset passwords use `password_hash()`.

## Main areas
- Patient portal
- Doctor portal
- Administrator portal
- Appointments
- Patient management
- Medical history
- Doctor management and specialization
- Reports and logs
- Contact/query management
- Password recovery and profile management
