<?php $this->title = 'Créez votre compte'; 
?>
<h2>Vos informations personnelles</h2>
<div>
    <a href="../public/index.php?route=editAccount">Modifier vos informations personnelles</a>
    <h3>Nom : </h3>
    <p><?= htmlspecialchars($user->getName()) ?></p>
    <h3>Prénom : </h3>
    <p><?= htmlspecialchars($user->getFirstName()) ?></p>
    <h3>Nom d'utilisateur : </h3>
    <p><?= htmlspecialchars($user->getUsername()) ?></p>
</div>
<a href="../public/index.php">Retour à l'accueil</a>
