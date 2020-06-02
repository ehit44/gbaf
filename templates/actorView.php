<?php $this->title = $actor->getActor(); ?>
<?= $this->session->show('post_opinion'); ?>

<h2><?= $actor->getActor();?></h2>

<div class="actorSingle">
<img class="logoActor" src="../public/img/<?= $actor->getLogo();?>" alt="<?= $actor->getActor();?>">
<p><?= $actor->getDescription();?></p>
</div>
<h3>Ce que vos collègues pensent de <?= $actor->getActor();?> : </h3>
<?php 
foreach ($opinions as $opinion) {
?>
<div class="opinion">
<p><?= htmlspecialchars($opinion->getOpinion());?></p>
<p>Posté le : <?= $opinion->getDate();?> par <?= htmlspecialchars($opinion->getUsername());?></p>
</div>
<?php 
}
?>
<form  method="post" action="../public/index.php?route=postOpinion&actorId=<?= $actor->getId();?>">
    <label for="opinion">Donnez votre avis sur <?= $actor->getActor();?></label><br>
    <textarea id="opinion" name="opinion"  rows="4" cols="50"> </textarea><br>
    <input type="submit" value="Envoyer" id="submit" name="submit">
</form>
<a href="../public/index.php">Retour à l'accueil</a>


