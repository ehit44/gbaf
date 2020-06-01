<?php $this->title = $actor->getActor(); ?>
<?= $this->session->show('log_account'); ?>

<h2><?= $actor->getActor();?></h2>

<div class="actorSingle">
<img class="logoActor" src="../public/img/<?= $actor->getLogo();?>" alt="<?= $actor->getActor();?>">
<p><?= $actor->getDescription();?></p>
</div>
<a href="../public/index.php">Retour à l'accueil</a>


