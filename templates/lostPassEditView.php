<?php $this->title = 'Mot de passe oublié'; 
$username = isset($user) && $user->getUsername() ? htmlspecialchars($user->getUsername()) : '';
$question = isset($user) && $user->getQuestion() ? htmlspecialchars($user->getQuestion()) : ''; 
?>

<h2>Vous avez oublié votre mot de passe ?</h2>

<h3>Répondez à votre question secrète pour changer votre mot de passe</h3>
<div>
    <form method="post" action="../public/index.php?route=lostPass">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username" readonly="readonly" value="<?= $username ?>"><br>
        <label for="secretQuestion"><?= 'Votre question secrète : ' . $question ?></label><br>
        <input type="text" id="secretQuestion" name="secretQuestion"><br>
        <?= isset($errors['secretQuestion']) ? $errors['secretQuestion'] : ''; ?>
        <label for="password">Nouveau mot de passe</label><br>
        <input type="password" id="password" name="password"><br>
        <?= isset($errors['password']) ? $errors['password'] : ''; ?>
        <input type="submit" value="Modifier le mot de passe" id="submit" name="submitEdit">
    </form>
</div>

<a href="../public/index.php?route=login">Connexion</a>
