<?php $title = 'Connexion'; 
$this->session->show('need_login');
?>

<h2>Connexion</h2>
<div>
    <form method="post" action="../public/index.php?route=login">
        <label for="username">Nom d'utilisateur</label><br>
        <input type="text" id="username" name="username"><br>
        <?= isset($errors['username']) ? $errors['username'] : ''; ?>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password"><br>
        <?= isset($errors['password']) ? $errors['password'] : ''; ?>
        <input type="submit" value="Connexion" id="submit" name="submit">
    </form>
</div>
<a href="../public/index.php?route=lostPass">Mot de passe oublié ?</a>
<a href="../public/index.php?route=register">Pas encore de compte ? Inscrivez-vous</a>
