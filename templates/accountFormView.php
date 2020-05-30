<?php 
$heading = isset($user) ? 'Modifiez vos informations personnelles' : 'Créez votre compte'; 
$route = isset($user) ? 'editAccount' : 'register'; 
$submit = isset($user) ? 'Modifier' : 'Inscription'; 
$name = isset($user) && $user->getName() ? htmlspecialchars($user->getName()) : ''; 
$firstName = isset($user) && $user->getFirstName() ? htmlspecialchars($user->getFirstName()) : ''; 
$username = isset($user) && $user->getUsername() ? htmlspecialchars($user->getUsername()) : ''; 
$question = isset($user) && $user->getQuestion() ? htmlspecialchars($user->getQuestion()) : ''; 
$response = isset($user) && $user->getResponse() ? htmlspecialchars($user->getResponse()) : ''; 
$this->title = $heading; 
?>
<h2><?= $heading ?></h2>
<div>
    <form method="post" action="../public/index.php?route=<?= $route ?>">
        <label for="name">Nom</label><br>
        <input type="text" id="name" name="name" value="<?= $name ?>" ><br>
        <?= isset($errors['name']) ? $errors['name'] : ''; ?>
        <label for="firstName">Prénom</label><br>
        <input type="text" id="firstName" name="firstName" value="<?= $firstName ?>"><br>
        <?= isset($errors['firstName']) ? $errors['firstName'] : ''; ?>
        <label for="username">Nom d'utilisateur</label><br>
        <input type="text" id="username" name="username" value="<?= $username ?>"><br>
        <?= isset($errors['username']) ? $errors['username'] : ''; ?>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password"><br>
        <?= isset($errors['password']) ? $errors['password'] : ''; ?>
        <label for="question">Question secrète</label><br>
        <input type="text" id="question" name="question" value="<?= $question ?>"><br>
        <?= isset($errors['question']) ? $errors['question'] : ''; ?>
        <label for="response">Réponse à la question secrète</label><br>
        <input type="text" id="response" name="response" value="<?= $response ?>"><br>
        <?= isset($errors['response']) ? $errors['response'] : ''; ?>
        <input type="submit" value="<?= $submit ?>" id="submit" name="submit">
    </form>
</div>
<?php if(isset($user)) {?>
<a href="../public/index.php?route=myAccount">Retour à mon compte</a>
<?php } else {?>
<a href="../public/index.php?route=login">Déjà inscrit ? Connectez-vous</a>
<?php } ?>
