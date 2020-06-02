<?php $this->title = $actor->getActor(); ?>
<?= $this->session->show('post_opinion'); ?>



<h2><?= $actor->getActor();?></h2>

<div class="actorSingle">
    <img class="logoActor" src="../public/img/<?= $actor->getLogo();?>" alt="<?= $actor->getActor();?>">
    <p><?= $actor->getDescription();?></p>
</div>
<h3>Ce que vos collègues pensent de <?= $actor->getActor();?> : </h3>
<div class="vote">
    <a href="../public/index.php?route=upVote&actorId=<?= $actor->getId();?>"><img class="icon" src="../public/icon/<?= $vote->getPositiveIcon();?>" alt="Noter comme positif"></a>
    <p><?= $vote->getPositiveVoteNb();?> ont donné une note positive</p>
    <a href="../public/index.php?route=downVote&actorId=<?= $actor->getId();?>"><img class="icon" src="../public/icon/<?= $vote->getNegativeIcon();?>" alt="Noter comme négatif"></a>
    <p><?= $vote->getNegativeVoteNb();?> ont donné une note négative</p>
</div>

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
    <?= isset($errors['opinion']) ? $errors['opinion'] : ''; ?>
    <input type="submit" value="Envoyer" id="submit" name="submit">
</form>
<a href="../public/index.php">Retour à l'accueil</a>


