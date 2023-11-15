<?php require "db.php";

@session_start();


// Check if the user is logged in and their role
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_role = null;

if ($user_id) {
    // Query the database to get the user's role
    $sql = "SELECT `role` FROM `user` WHERE `id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $user_role = $stmt->fetchColumn();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include CSS stylesheets and other necessary resources here -->
    <link rel="stylesheet" href="styling.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
                if ($user_role == 1) {
                    echo '<li><a href="adminpage.php">Admin panel</a></li>';
                }
                echo '<li><a href="profile.php">Profile</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

</html>
