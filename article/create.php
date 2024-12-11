<?php
require_once '../service/database.php';

if (isset($_POST['submit'])) {
    session_start();
    $content = $_POST['content'];
    $akun_id = $_SESSION['id'];

    $query = "INSERT INTO article (content, akun_id) VALUES ('$content', '$akun_id')";
    if (mysqli_query($connection, $query)) {
        header('Location: ../index.php');
        exit();
    } else {
        $error = "Error: " . $query . "<br>" . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>Make Suggestions</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .card {
            width: 50%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
        }

        textarea {
            width: 94%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-top: 10px;
            font-size: 14px;
            color: #333;
            resize: vertical;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            border: none;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .alert-danger {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .btn-back {
            text-decoration: none;
            font-size: 16px;
            color: #007bff;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Make Suggestions</h3>

        <?php if (isset($error)) : ?>
            <div class="alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <form action="create.php" method="post">
                <div class="form-group">
                    <label for="content">Fill Suggestions</label>
                    <textarea id="content" name="content" rows="6" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn-success">Submit</button>
            </form>
        </div>

        <a href="../index.php" class="btn-back">Back to Home</a>
    </div>

</body>

</html>
