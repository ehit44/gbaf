<?php $this->title = 'Créez votre compte'; 
?>
<h2>Vos informations personnelles</h2>
<div>
    <a href="../public/index.php?editAccount">Modifier vos informations personnelles</a>
    <h3>Nom : </h3>
    <p><?= $user['nom'] ?></p>
    <h3>Prénom : </h3>
    <p><?= $user['prenom'] ?></p>
    <h3>Nom d'utilisateur : </h3>
    <p><?= $user['username'] ?></p>
</div>
<a href="../public/index.php">Retour à l'accueil</a>
