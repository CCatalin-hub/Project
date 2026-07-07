<link rel="stylesheet" href="<?= base_url('assets/styles/GameCards.css') ?>">
<script src="<?= base_url('assets/scripts/GameTagsScrool.js') ?>"></script>

<div class="gameLibrary">
	<?php if (!empty($jeux)) : ?>
	  <?php foreach ($jeux as $jeu) : ?>
	    <div class="gameCard" onclick="location.href='<?= site_url('ModifBD/index/'.rtrim(strtr(base64_encode($jeu->name ?? ''), '+/', '-_'), '=')) ?>'">
	      <img class="gamePoster" src="data:image/jpeg;base64,<?= base64_encode($jeu->poster_jpeg) ?>" alt="Game Poster">

	      <div class="card-body">
	        <div class="top-row">
	          <h3 class="gameTitle"><?= $jeu->name ?? '' ?></h3>
	          <span class="gameMetacritic"><?= $jeu->metacritic ?? 'Pas de notte' ?></span>
	        </div>

	        <p class="gameDescription"><?= $jeu->shortDescription ?? '' ?></p>

	        <div class="divider"></div>

	        <div class="info-row">
	          <span class="gameReleaseYear"><?= $jeu->releaseYear ?? '' ?></span>
		  <span class="gamePrice"><?= ($jeu->price == 0) ? 'Gratuit' : $jeu->price.'$' ?></span>
		</div>

	        <div class="platforms">
	          <span class="gamePlatform" <?= ($jeu->windows == 1) ? '' : 'style="display: none;"' ?>>Windows</span>
	          <span class="gamePlatform" <?= ($jeu->mac == 1) ? '' : 'style="display: none;"' ?>>Mac</span>
	          <span class="gamePlatform" <?= ($jeu->linux == 1) ? '' : 'style="display: none;"' ?>>Linux</span>
	        </div>
	        
	        <?php $genresArray = explode(', ', $jeu->genres ?? ''); ?>

	        <div class="tags">
	          <?php foreach ($genresArray as $genre) : ?>
	            <span class="gameTag"><?= $genre ?></span>
	          <?php endforeach; ?>
	        </div>

	        <?php $categoriesArray = explode(', ', $jeu->categories ?? ''); ?>

	        <div class="tags second-row">
	          <?php foreach ($categoriesArray as $category) : ?>
	            <span class="gameTag"><?= $category ?></span>
	          <?php endforeach; ?>
	        </div>

	        <p class="gameDeveloper"><?= $jeu->developer_name ?? '' ?></p>

	      </div>
	    </div>
	  <?php endforeach; ?>
	<?php endif; ?>
</div>

<a href="<?= site_url('ModifBD/ajouter') ?>" class="btnAjouter" title="Ajouter un jeu">
    <span>+</span>
</a>
