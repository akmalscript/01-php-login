<?php
    include "service/database.php";
    session_start();

    $register_message = "";

    if(isset($_SESSION['is_login'])) {
        header("location: dashboard.php");
    }

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash('sha256', $password);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";

        try {
            if($db->query($sql)) {
                $register_message = "Registration Successful: Please log in.";
            } else {
                $register_message = "Registration Failed: Database connection error.";
            }
        } catch (mysqli_sql_exception) {
            $register_message = "Username already exists. Please choose a different username.";
        }
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include "layout/header.html"; ?>

    <h3>Create a new account</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <button type="submit" name="register">Register</button>
    </form>

    <?php include "layout/footer.html"; ?>
</body>
</html>