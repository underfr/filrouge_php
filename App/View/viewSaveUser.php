<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/style/main.css">
    <title>Register</title>
</head>
<body>
    <?php include "App/View/components/navbar.php"; ?>
    <h1>Inscription</h1>
    <form action="" method="POST">
        <label for="firstname">Firstname :</label>
        <input type="text" name="firstname" id="firstname" placeholder="Michel">
        <label for="lastname">Lastname :</label>
        <input type="text" name="lastname" id="lastname" placeholder="Delpech">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" placeholder="micheldelpech@gmail.com">
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" placeholder="********">
        <input type="submit" value="Register" name="register">
    </form>
    <p><?= $message ?></p>
</body>
</html>
