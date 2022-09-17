<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: oldlace">
    <form action="" method="post" name="singup" style="display: flex; flex-direction: column; width: 20%; margin-left: auto; margin-right: auto; margin-top: 20%;">
        <label for="login">Login:</label>
        <input type="text" name="login">
        <label for="password">Password:</label>
        <input type="password" name="password">
        <button type="submit" name="register" value="register">Register</button>
    </form>

    <form action="" method="post" name="logup" style="display: flex; flex-direction: column; width: 20%; margin-left: auto; margin-right: auto; margin-top: 5%;">
        <label for="login">Login:</label>
        <input type="text" name="login1">
        <label for="password">Password:</label>
        <input type="password" name="password1">
        <button type="submit" name="login" value="register">Login</button>
    </form>

    <?php

        session_start();
        session_name();

        define('host', 'localhost');
        define('user', 'root');
        define('password', 'nostroguardian');
        define('database', 'test');

        $connection = mysqli_connect(host, user, password, database) or die('Unable to connect with mysql');

        if (isset($_POST['register'])) {
            $user_login = $_POST['login'];
            $user_password = $_POST['password'];
            $password_hash = password_hash($user_password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users (login, password) VALUES ('$user_login', '$password_hash')";
            if ($result = mysqli_query($connection, $query)) {
                echo '<p>Registred as </p>' . $user_login;
            } else {
                echo 'Error: ' . mysqli_error($connection);
            }
        } else if (isset($_POST['login'])) {
            $user_login = $_POST['login1'];
            $user_password = $_POST['password1'];
            $query = "SELECT * FROM users WHERE login='$user_login'";
            if ($result = mysqli_query($connection, $query)) {
                $data = mysqli_fetch_array($result);
                if (password_verify($user_password, $data['password'])) {
                    $_SESSION['user_id'] = $data['id'];
                    $_SESSION['user_name'] = $data['login'];
                    echo 'Login OK!';
                    header('Location: locked.php');
                    exit;
                } else {
                    header('Location: index.php');
                    echo '<p>Wrong credentials!</p>';
                }

            } else {
                echo 'Error: ' . mysqli_error($connection);
            }
        }
        mysqli_close($connection);
    ?>

</body>
</html>
