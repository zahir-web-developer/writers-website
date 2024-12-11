<?php
require_once '../service/database.php';
session_start();

$id = $_GET['id'];
$query = "DELETE FROM article WHERE id_article = $id AND akun_id = " . $_SESSION['id'];
if (mysqli_query($connection, $query)) {
    header('Location: ../index.php');
    exit();
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}
