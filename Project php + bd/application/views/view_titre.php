<link rel="stylesheet" href="<?= base_url('assets/styles/titreStyle.css') ?>">
<div class="titleBlock">
	<h1 class="pageTitle"><?= htmlspecialchars($message) ?></h1>

	<?php if ($count > 0): ?>
	    <h2 class="pageInfo">Résultats trouvés : <?= $count ?></h2>
	<?php endif; ?>
</div>