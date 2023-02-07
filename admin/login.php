<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
    <?php include('./fontend/header.php'); ?>
</head>
<body>
    <div class="login">
        <form action="includes/login.inc.php" method="post">
            <label for="chk" aria-hidden="true">Login</label>
            <input id="login-uid" type="text" name="uid" placeholder="username" required="">
            <input id="login-pwd" type="password" name="pwd" placeholder="Password" required="">
            <button id="login-submit" type="submit" name="submit-login">Login</button>
        </form>
    </div>
</body>
</html>