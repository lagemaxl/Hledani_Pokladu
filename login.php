<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/form.css">
</head>
<body>
<div class="container">
    <form action="server.php" method="POST" class="form">
        <label>Email:</label>
        <input type="email" name="email"><br>
        <label>Heslo:</label>
        <input type="password" name="password"><br>
        <input type="submit" name="login" value="Přihlásit se">
        <a href="game.php">
        <input type="submit" name="NoLogin" value="Hrát bez přihlášení">
        </a>
        <p>Nemáte účet? <a href="registrace.php">Zaregistrovat se</a></p>
    </form>


    <img src="files/Matav1.png" class="Matav1">
</div>

</body>
</html>