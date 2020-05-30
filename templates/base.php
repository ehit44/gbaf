<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
<div class="header">
HEADER
<a href="../public/index.php?route=logout">Déconnexion</a>
</div>
    <div id="content">
        <?= $content ?>
    </div>
<div class="footer">FOOTER</div>

</body>
</html>