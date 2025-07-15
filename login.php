<?php
    include "service/database.php";
    session_start();

    $login_message = "";

    if(isset($_SESSION['is_login'])) {
        header("location: dashboard.php");
    }

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash('sha256', $password);

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";

        $result = $db->query($sql);

        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION['username'] = $data['username'];
            $_SESSION['is_login'] = true;

            header("location: dashboard.php");
        } else {
            $login_message = "Account Not Found!";
        }
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include "layout/header.html"; ?>

    <h3>Login to account</h3>
    <i><?= $login_message ?></i>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <button type="submit" name="login">Login</button>
    </form>

    <?php include "layout/footer.html"; ?>
</body>
</html>