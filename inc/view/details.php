<article id="details">
	<div class="detailsLeft">
		<div class="affiche"><img src="<?php echo $filmObject->getAffiche(); ?>" border="0" width="200" /></div>
		<div class="annee">Sortie en <?php echo $filmObject->getAnnee(); ?></div>
		<div class="support">Support : <?php echo $filmObject->getSupport()->getNom(); ?></div>
	</div>
	<div class="detailsRight">
		<div class="titre"><?php echo $filmObject->getTitre(); ?></div>
		<div class="categorie"><?php echo $filmObject->getCategorie()->getNom(); ?></div>
		<br /><br />
		<div class="synopsis"><?php echo $filmObject->getSynopsis(); ?></div>
		<div class="acteurs"><?php echo $filmObject->getActeurs(); ?></div>
		<div class="fichier">=> <?php echo $filmObject->getFilename(); ?></div>
	</div>
</article>