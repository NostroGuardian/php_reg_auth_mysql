<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locked Page</title>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit;
    } else {
        $user = $_SESSION['user_name'];
    }
    ?>
    <h1 style="text-align: center; margin-top: 20%; font-family: 'Arial';">You can see locked page!</h1>
    <h2 style="text-align: center; font-family: 'Arial';">Welcome, <span style="color: darkcyan"><?php echo $user; ?></span>!</h2>
    <i style="text-align: center; display: block;"><a href="exit.php" style="color: brown; font-family: 'Arial';">Выйти с сайта</a></i>
</body>
</html>