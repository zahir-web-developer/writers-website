<?php
require_once 'database.php';

$queries = [
    "CREATE TABLE IF NOT EXISTS akun (
        id INT AUTO_INCREMENT primary KEY,
        email VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        is_admin BOOLEAN DEFAULT false
    )",
    "CREATE TABLE IF NOT EXISTS article (
        id_article INT AUTO_INCREMENT primary KEY,
        content TEXT NOT NULL,
        akun_id INT,
        FOREIGN KEY (akun_id) REFERENCES akun(id)
    )",
];
foreach ($queries as $query) {
    if (mysqli_query($connection, $query)) {
        echo "Table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($connection);
    }
}
