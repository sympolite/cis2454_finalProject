<?php
/* Timothy Ian Anderson
 * CIS 2454 - Thurs Afternoon
 * Integrated Project
 */
$dsn = 'mysql:host=localhost;dbname=codingex6db';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    exit;
}
?>

