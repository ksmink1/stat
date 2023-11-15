

<?php

include('header.php');
include('db.php');

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql = "SELECT * FROM `user` WHERE `id` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch basic team-related data for the user
$sqlTeam = "SELECT * FROM `players` WHERE `PlayerID` = ?";
$stmtTeam = $pdo->prepare($sqlTeam);
$stmtTeam->execute([$user_id]);
$player = $stmtTeam->fetch(PDO::FETCH_ASSOC);

// You need to add logic to fetch and display stats per team

// Handle updating user information
if (isset($_POST['update_profile'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Add code to update user information in the database
    $updateSql = "UPDATE `user` SET `email` = ? WHERE `id` = ?";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute([$email, $user_id]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>

<div class="profile-form">
    <h2>My Profile</h2>
    <form action="profile.php" method="POST">
        <div class="mb-3">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required>
        </div>
        <!-- Add more form fields for other user-related data -->

        <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
    </form>
</div>

<!-- Add sections for viewing stats per team and other information -->
<div class="stats-section">
    <h2>Stats per Team</h2>
    <!-- Display stats per team based on your database structure -->
    <p>Team Name: <?= $player['TeamName'] ?></p>
    <p>Goals Scored: <?= $player['GoalsScored'] ?></p>
    <!-- Add more stats as needed -->
</div>

</body>
</html>
