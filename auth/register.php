<?php
require_once '../service/database.php';

if (isset($_POST['submit'])) {
    global $connection;
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Validation
    $errors = [];
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $password2) {
        echo "<script>alert('Passwords do not match!');</script>";
        return;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    if (empty($errors)) {
        // Check if email already exists
        $check_query = "SELECT * FROM akun WHERE email = '$email'";
        $check_result = mysqli_query($connection, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $errors[] = "Email already exists.";
        } else {
            $query = "INSERT INTO akun (email, username, password, is_admin) VALUES ('$email','$username', '$password', false)";
            if (mysqli_query($connection, $query)) {
                header('Location: login.php');
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($connection);
            }
        }
    }
}
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
    <title>Register</title>
    <style>
        body {
            background-color: #6c757d;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-card h3 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }

        .form-control {
            width: 94%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: none;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 12px;
            font-size: 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .alert {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php if (!empty($errors)): ?>
        <div class="alert">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="form-card">
            <h3>Register</h3>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password2" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
                <button type="submit" name="submit" class="btn-submit">Register</button>
            </form>
        </div>
    </div>
</body>

</html>
