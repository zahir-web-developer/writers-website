<?php
session_start();
require_once '../service/database.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0) {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'];
$query = "UPDATE akun SET is_admin = CASE WHEN is_admin = 1 THEN 0 ELSE 1 END WHERE id = $id";
if (mysqli_query($connection, $query)) {
    header('Location: ../admin/index.php');
    exit();
} else {
    echo "Error updating record: " . mysqli_error($connection);
}

