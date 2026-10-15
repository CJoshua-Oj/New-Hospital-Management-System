<?php
/**
 * New Hospital Management System - PHP 8.3 configuration.
 * Update these values for your MySQL/MariaDB installation.
 */
define('DB_SERVER', getenv('HMS_DB_HOST') ?: 'localhost');
define('DB_USER', getenv('HMS_DB_USER') ?: 'root');
define('DB_PASS', getenv('HMS_DB_PASS') ?: '');
define('DB_NAME', getenv('HMS_DB_NAME') ?: 'hmsss');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    mysqli_set_charset($con, 'utf8mb4');
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    die('Database connection failed. Check include/config.php and make sure the database exists.');
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function hms_password_verify(string $password, string $stored): bool {
    if ($stored === '') return false;
    if (password_get_info($stored)['algo'] !== 0) {
        return password_verify($password, $stored);
    }
    // Backward compatibility for legacy MD5/plain-text records.
    return hash_equals(strtolower($stored), md5($password)) || hash_equals($stored, $password);
}

function hms_password_upgrade(mysqli $con, string $table, int $id, string $password): void {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($con, "UPDATE `$table` SET password=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'si', $hash, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function hms_client_ip(): string {
    return $_SERVER['REMOTE_ADDR'] ?? '';
}
?>
