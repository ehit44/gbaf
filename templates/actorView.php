<?php $this->title = $actor->getActor(); ?>
<?= $this->session->show('post_opinion'); ?>

<h2><?= $actor->getActor();?></h2>

<div class="actorSingle">
<img class="logoActor" src="../public/img/<?= $actor->getLogo();?>" alt="<?= $actor->getActor();?>">
<p><?= $actor->getDescription();?></p>
</div>
<form  method="post" action="../public/index.php?route=postOpinion&actorId=<?= $actor->getId();?>">
    <label for="opinion">Donnez votre avis sur <?= $actor->getActor();?></label><br>
    <textarea id="opinion" name="opinion"  rows="4" cols="50"> </textarea><br>
    <input type="submit" value="Envoyer" id="submit" name="submit">
</form>
<a href="../public/index.php">Retour à l'accueil</a>


