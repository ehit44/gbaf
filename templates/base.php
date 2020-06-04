<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
<div class="header">
<a href="../public/index.php"><img class="logo" src="../public/img/gbaf-logo.png" alt="GBAF"></a>
<?php if($this->session->get('id_user')) { ?>
<a href="../public/index.php?route=logout"><img class="icon" src="../public/icon/logout.png" alt="Déconnexion">Déconnexion</a>
<a href="../public/index.php?route=myAccount"><img class="icon" src="../public/icon/user.png" alt="Déconnexion"><?= $this->session->get('username') ?></a>
<?php } ?>
</div>
    <div id="content">
        <?= $content ?>
    </div>
<div class="footer">FOOTER</div>

</body>
</html>