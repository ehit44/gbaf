<?php $this->title = 'Extranet GBAF'; ?>
<?= $this->session->show('log_account'); ?>


<h1>Le Groupement Banque Assurance Français</h1>
<p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous  les axes de la 
réglementation financière française. Sa mission est de promouvoir  l'activité bancaire à l’échelle nationale. 
C’est aussi un interlocuteur privilégié des  pouvoirs publics. </p>

<h2>Liste des acteurs</h2>
<?php 
foreach ($actors as $actor) {
?>
<div class="actor">
<img class="logoActor" src="../public/img/<?= $actor->getLogo();?>" alt="<?= $actor->getActor();?>">
<h3><?= $actor->getActor();?></h3>
<p><?= substr($actor->getDescription(), 0, 255);?>...</p>
<a href="../public/index.php?route=getActor&actorId=<?= $actor->getId();?>">Voir plus</a>
</div>

<?php }?>
