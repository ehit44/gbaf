<?php $title = 'Créez votre compte'; 
?>
<h2>Créez votre compte</h2>
<div>
    <form method="post" action="../public/index.php?route=register">
        <label for="name">Nom</label><br>
        <input type="text" id="name" name="name"><br>
        <?= isset($errors['name']) ? $errors['name'] : ''; ?>
        <label for="firstName">Prénom</label><br>
        <input type="text" id="firstName" name="firstName"><br>
        <?= isset($errors['firstName']) ? $errors['firstName'] : ''; ?>
        <label for="username">Nom d'utilisateur</label><br>
        <input type="text" id="username" name="username"><br>
        <?= isset($errors['username']) ? $errors['username'] : ''; ?>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password"><br>
        <?= isset($errors['password']) ? $errors['password'] : ''; ?>
        <label for="question">Question secrète</label><br>
        <input type="text" id="question" name="question"><br>
        <?= isset($errors['question']) ? $errors['question'] : ''; ?>
        <label for="response">Réponse à la question secrète</label><br>
        <input type="text" id="response" name="response"><br>
        <?= isset($errors['response']) ? $errors['response'] : ''; ?>
        <input type="submit" value="Inscription" id="submit" name="submit">
    </form>
</div>
<a href="../public/index.php?route=login">Déjà inscrit? Connectez-vous</a>
