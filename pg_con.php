<?php
// PostgreSQL connection (configurable via environment variables).
$dbHost = getenv('GYM_DB_HOST') ?: 'localhost';
$dbPort = getenv('GYM_DB_PORT') ?: '5433';
$dbName = getenv('GYM_DB_NAME') ?: 'gym_mang_system_v1';
$dbUser = getenv('GYM_DB_USER') ?: 'gym_mang_user';
$dbPass = getenv('GYM_DB_PASSWORD') ?: 'gym_mang_pass_2026';

$connStr = sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    $dbHost,
    $dbPort,
    $dbName,
    $dbUser,
    $dbPass
);

$con = @pg_connect($connStr);
if (!$con) {
    $db_error = "Database connection failed. Check PostgreSQL credentials in environment variables.";
}
?>
