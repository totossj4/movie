<section>
	<p id="homeItro">GCLF est une superbe et ingénieuse application permettant de gérer la localisation et la recherche de ses copies légales de films</p>
	<br /><br />
	<form action="index.php" method="get" id="homeSearch">
		<input type="hidden" name="section" value="catalogue" />
		<input type="text" class="searchInput" placeholder="Titre, acteur, etc." name="q" value="" />
		<input type="submit" class="searchSubmit" value="Rechercher"/>
	</form>
</section>
<section class="listeCategories">
	<?php foreach ($categorieList as $curCategorie) : ?>
	<a href="index.php?section=catalogue&cat_id=<?php echo $curCategorie->getId(); ?>"><?php echo $curCategorie->getNom().' ('.$curCategorie->getNbFilms().')'; ?></a>&nbsp; &nbsp;
	<?php endforeach; ?>
</section>