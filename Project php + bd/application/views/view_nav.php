<link rel="stylesheet" href="<?= base_url('assets/styles/navBarStyle.css') ?>">
<script src="<?= base_url('assets/scripts/navBarScript.js') ?>"></script>

<nav>
  <div class="filters">
    <form id="sortForm" method="get">
      <label for="sort">Sort by:</label>
      <select id="sort" <?= $isOn ? '' : 'disabled' ?>>
        <option value="name">Name</option>
        <option value="date">Date</option>
      </select>

      <button type="button" id="orderBtn" <?= $isOn ? '' : 'disabled' ?>>⮝</button>
    </form>
  </div>

  <input class="searchBar" type="text" id="search" placeholder="Search...">
  <button class="searchBar" id="go">Search</button>

  <a class="homeButton" href="<?= base_url() ?>">Home</a>

  <div class="dropdown">
    <span class="dropdownTrigger">
      Genres
      <span class="dropdownArrow">⮞</span>
    </span>

    <div class="dropdownPanel">
      <?php foreach($genres as $genre): ?>
        <a href="<?= site_url("GameBD/genre/".rtrim(strtr(base64_encode($genre->description), '+/', '-_'), '=')); ?>">
          <?= $genre->description; ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="dropdown">
    <span class="dropdownTrigger">
      Categories
      <span class="dropdownArrow">⮞</span>
    </span>

    <div class="dropdownPanel">
      <?php foreach($categories as $categorie): ?>
        <a href="<?=site_url("GameBD/categorie/".rtrim(strtr(base64_encode($categorie->description), '+/', '-_'), '=')); ?>">
          <?= $categorie->description; ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</nav>
