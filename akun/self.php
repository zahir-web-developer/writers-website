<?php
session_start();
require_once '../service/database.php';

// Ambil artikel pengguna berdasarkan sesi ID
$query = "SELECT * FROM article WHERE akun_id = " . $_SESSION['id'];
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>My Suggestions</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,200..800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80vw;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #0d6efd;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .btn-action {
            padding: 8px 12px;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-container {
            display: flex;
            gap: 10px;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .no-suggestions {
            text-align: center;
            color: #555;
            font-size: 16px;
            margin-top: 20px;
        }


    </style>
</head>

<body>
<h1>My Suggestions</h1>
    <div class="container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Suggestions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo htmlspecialchars($row['content']); ?></td>
                            <td class="action-buttons">
                                <a href="../article/update.php?id=<?php echo $row['id_article']; ?>" class="btn-action btn-success">Update</a>
                                <a href="../article/delete.php?id=<?php echo $row['id_article']; ?>" class="btn-action btn-danger" onclick="return confirm('Are you sure you want to delete this suggestion?');">Delete</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-suggestions">You have not made any suggestions yet.</p>
        <?php endif; ?>
    </div>
</body>

</html>
