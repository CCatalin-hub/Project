<link rel="stylesheet" href="<?= base_url('assets/styles/pagesBar.css') ?>">

<div class="pageSelector">
	<form method="post">
		<button type="submit" name="page" value="1" <?= ($currentPage == 1) ? 'disabled' : '' ?>>«</button>
		<button type="submit" name="page" value="<?= $currentPage-1 ?>"<?= ($currentPage == 1) ? 'disabled' : '' ?>>‹</button>

		<?php
			if ($currentPage === 1){
				for ($i=1; $i <= min($maxPages, 3); $i++){
					$disabled = ($i == $currentPage) ? ' disabled' : '';
					echo '<button type="submit" name="page" value="'.$i.'"'.$disabled.'>'.$i.'</button>';
				}

			}elseif ((int)$currentPage === (int)$maxPages){
			     for ($i = max(1, $currentPage-2); $i <= $currentPage; $i++){
			        $disabled = ($i == $currentPage) ? ' disabled' : '';
			        echo '<button type="submit" name="page" value="'.$i.'"'.$disabled.'>'.$i.'</button>';
			    }
			    
			}else{
				echo '<button type="submit" name="page" value="'.($currentPage-1).'">'.($currentPage-1).'</button>';
				echo '<button type="submit" name="page" value="'.$currentPage.'" disabled>'.$currentPage.'</button>';
				echo '<button type="submit" name="page" value="'.($currentPage+1).'">'.($currentPage+1).'</button>';
			}
		?>

		<button type="submit" name="page" value="<?= $currentPage+1 ?>"<?= ($currentPage == $maxPages) ? 'disabled' : '' ?>>›</button>
		<button type="submit" name="page" value="<?= $maxPages ?>"<?= ($currentPage == $maxPages) ? 'disabled' : '' ?>>»</button> 
	</form>
</div>