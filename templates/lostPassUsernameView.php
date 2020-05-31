<?php $this->title = 'Mot de passe oublié'; 
?>

<h2>Vous avez oublié votre mot de passe ?</h2>

<div>
    <form method="post" action="../public/index.php?route=lostPass">
        <label for="username">Quel est votre nom d'utilisateur ?</label><br>
        <input type="text" id="username" name="username"><br>
        <?= isset($errors['username']) ? $errors['username'] : ''; ?>
        <input type="submit" value="Valider" id="submit" name="submitUsername">
    </form>
</div>

<a href="../public/index.php?route=login">Connexion</a>
