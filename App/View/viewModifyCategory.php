<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/main.css">
    <title>Editer Categorie</title>
</head>

<body>
    <?php include "App/View/components/navbar.php"; ?>
    <h1>Editer la catégorie</h1>
    <form action="" method="post">
        <input type="text" name="name" placeholder="Saisir le nom de la categorie" value="<?= $cat->GetName() ?>">

        <input type="hidden" name="id" value="<?= $cat->getIdCategory() ?>">
        <input type="submit" value="Enregistrer" name="submit">
    </form>
</body>

</html>
