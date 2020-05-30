<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
<div class="header">
<a href="../public/index.php">HEADER</a>
<?php if($this->session->get('id_user')) { ?>
<a href="../public/index.php?route=logout">Déconnexion</a>
<a href="../public/index.php?route=myAccount"><?= $this->session->get('username') ?></a>
<?php } ?>
</div>
    <div id="content">
        <?= $content ?>
    </div>
<div class="footer">FOOTER</div>

</body>
</html>