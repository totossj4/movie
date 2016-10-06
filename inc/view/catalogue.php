<section class="pagination">
	<?php
	if ($currentPage >= 2) {
	?>
	<a href="?section=catalogue&page=<?php echo $currentPage-1; ?>&q=<?php echo $searchTerms; ?>&cat_id=<?php echo $categorieId; ?>">&lt; précédent</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php
	}
	if (sizeof($filmList) >= 4) {
	?>
	<a href="?section=catalogue&page=<?php echo $currentPage+1; ?>&q=<?php echo $searchTerms; ?>&cat_id=<?php echo $categorieId; ?>">suivant &gt;</a>
	<?php
	}
	?>	
</section>
<section class="filmList">
	<?php
	// Si la variable $filmList existe et si elle contient plusieurs lignes
	if (isset($filmList) && sizeof($filmList) > 0) {
		foreach ($filmList as $currentFilm) {
		?>
		<article>
			<div class="content">
				<a href="index.php?section=details&id=<?php echo $currentFilm->getId(); ?>"><img src="<?php echo $currentFilm->getAffiche(); ?>" border="0" /></a>
				<div class="titre">
					#<?php echo $currentFilm->getId(); ?>&nbsp;
					<a href="index.php?section=details&id=<?php echo $currentFilm->getId(); ?>"><?php echo $currentFilm->getTitre(); ?></a>
				</div>
				<div class="synopsis">
					<?php echo $currentFilm->getSynopsis(); ?>
				</div>
			</div>
			<div class="actions">
				<a class="btn" href="index.php?section=details&id=<?php echo $currentFilm->getId(); ?>">Détails</a><br />
				<a class="btn" href="form_film.php?id=<?php echo $currentFilm->getId(); ?>">Modifier</a><br />
			</div>
		</article>
		<?php
		}
	}
	?>
</section>