<?php
session_start();
require_once '../service/database.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0) {
    header('Location: ../index.php');
    exit();
}

$query = "SELECT article.id_article, article.content, akun.email FROM article JOIN akun ON article.akun_id = akun.id";
$result = mysqli_query($connection, $query);

$akun_query = "SELECT id, email FROM akun";
$akun_result = mysqli_query($connection, $akun_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
    </style>
    <title>List Suggestions</title>
    <style>
        body {
            background-color: #f1f1f1;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 1rem;
        }

        .container {
            display: flex;
            gap: 2rem;
            padding: 1rem;
            margin: 0 auto;
            width: 80vw;
        }

        .btn-back {
            display: inline-block;
            text-decoration: none;
            color: #000;
            font-weight: 600;
            font-size: 1.5rem;
            background-color: #87ceeb;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #4682b4;
        }

        .table-container {
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .table-container td {
            width: 20rem;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8fafc;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 0.9rem;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        @media screen and (max-width:768px) {

            h1 {
                font-size: 23px;
            }

            .container {
                display: flex;
                flex-direction: column;
            }

            .table-container td {
                width: 15rem;
            }

            .table-container {
                width: auto;
            }

            .btn-success {
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 0.9rem;
            }
        }

        @media screen and (max-width:1024px) {
            .table-container {
                width: auto;
            }

            .btn-success {
                width: auto;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <a class="btn-back" href="../index.php">Back to Home</a>

    <div class="container">
        <!-- List All Suggestions (Left Side) -->
        <div class="table-container">
            <h1>List All Suggestions</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Suggestions</th>
                        <th>Username</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $no . '</td>';
                        echo '<td>' . $row['content'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>';
                        echo '<a href="./delete.php?id=' . $row['id_article'] . '" class="btn-action btn-danger">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Account List (Right Side) -->
        <div class="table-container">
            <h1>Account List</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($akun_row = mysqli_fetch_assoc($akun_result)) {
                        echo '<tr>';
                        echo '<td>' . $akun_row['id'] . '</td>';
                        echo '<td>' . $akun_row['email'] . '</td>';
                        echo '<td>';
                        if ($akun_row['id'] != $_SESSION['id']) {
                            $query_admin_check = "SELECT is_admin FROM akun WHERE id = " . $akun_row['id'];
                            $admin_result = mysqli_query($connection, $query_admin_check);
                            $admin_row = mysqli_fetch_assoc($admin_result);
                            $is_admin = $admin_row['is_admin'];
                            echo ($is_admin == 1) ? 
                            '<a href="../admin/crud.php?id=' . $akun_row['id'] . '" class="btn-action btn-danger">Remove Admin!</a>' :
                            '<a href="../admin/crud.php?id=' . $akun_row['id'] . '" class="btn-action btn-success">Make Author</a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
