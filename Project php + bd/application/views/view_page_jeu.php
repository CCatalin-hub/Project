<link rel="stylesheet" href="<?= base_url('assets/styles/pageJeuxStyle.css') ?>">
<script src="<?= base_url('assets/scripts/ajouterGenreOuCategories.js') ?>"></script>

<div class="game-wrapper">
    <?php if (!empty($jeu) ): ?>
        
        <div class="game_ard">
            
            <div class="left_column">
                
                <div class="game_poster">
                    <?php if (!empty($jeu->poster_jpeg)): ?>
                        <img class="game_image" src="data:image/jpeg;base64,<?= base64_encode($jeu->poster_jpeg) ?>" alt="Game Poster">
                    <?php else: ?>
                        <div class="game_image empty_image">Aucune image disponible</div>
                    <?php endif; ?>
                </div>

                <div class="main_info_box">
                    <h3 class="game_title"><?= htmlspecialchars($jeu->name ?? '') ?></h3>
                    
                    <div class="metacritic">
                        <span class="metacritic_text">Note Metacritic :</span>
                        <?php if ($jeu->metacritic !== null && $jeu->metacritic !== "" && $jeu->metacritic !== "null" && $jeu->metacritic >= 0 && $jeu->metacritic <= 100): ?>
                            <span class="game_metacritic"><?= $jeu->metacritic ?>/100</span>
                        <?php else: ?>
                            <span class="game_metacritic">Pas de notte</span>
                        <?php endif; ?>
                    </div>

                    <div class="anne_creation">
                        <span class="section_title">Anne de creation :</span>
                        <span> <?= $jeu->releaseYear ?> </span>
                    </div>

                    <div class="platform_container">
                        <span class="section_title">OS :</span>
                        <div class="badge_list">
                            <span class="platform_badge" <?= ($jeu->windows == 1) ? '' : 'style="display: none;"' ?>>Windows</span>
                            <span class="platform_badge" <?= ($jeu->mac == 1) ? '' : 'style="display: none;"' ?>>Mac</span>
                            <span class="platform_badge" <?= ($jeu->linux == 1) ? '' : 'style="display: none;"' ?>>Linux</span>
                        </div>
                    </div>

                    <div class="developer_name">
                        <span class="section_title">Developer :</span>
                        <span> <?= $jeu->developer_name ?> </span>
                    </div>

                    <div class="price">
                        <span class="section_title">price :</span>
                        <span> <?= ($jeu->price == 0) ? 'Gratuit' : $jeu->price.'$' ?> </span>
                    </div>

                </div>
            </div>

            <div class="right_column">
                
                <?php if (!empty($jeu->genres)): ?>
                    <?php $genresArray = explode(', ', $jeu->genres); ?>
                    <div class="section">
                        <span class="section_title">Genres :</span>
                        <div class="badge_list">
                            <?php foreach ($genresArray as $genre) : ?>
                                <a class="genre_gategory_badge" href="<?= site_url("GameBD/genre/".rtrim(strtr(base64_encode($genre), '+/', '-_'), '=')); ?>"><?= htmlspecialchars($genre) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($jeu->categories)): ?>
                    <?php $categoriesArray = explode(', ', $jeu->categories); ?>
                    <div class="section">
                        <span class="section_title">Catégories :</span>
                        <div class="badge_list">
                            <?php foreach ($categoriesArray as $category) : ?>
                                <a class="genre_gategory_badge" href="<?= site_url("GameBD/categorie/".rtrim(strtr(base64_encode($category), '+/', '-_'), '=')); ?>"><?= htmlspecialchars($category) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="divider"></div>

                <div class="section">
                    <span class="section_title">Description :</span>
                    <p class="game_description"><?= htmlspecialchars($jeu->shortDescription ?? '') ?></p>
                </div>

                <?php if (!empty($jeu->developer)): ?>
                    <div class="section">
                        <span class="section_title">Créateur :</span>
                        <p class="game_developer"><?= htmlspecialchars($jeu->developer) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="action_container">
            <button type="button" class="btn-delete" onclick="ouvrirConfirmation()">
                Supprimer
            </button>
            <a href="<?= site_url('ModifBD/modifier/'.rtrim(strtr(base64_encode($jeu->name ?? ''), '+/', '-_'), '=')) ?>" class="btn-edit">
                Modifier
            </a>
        </div>

        <dialog id="fenetre-suppression" class="delete-fenetre">
            <div class="fenetre-content">
                <h3 class="game_title">Confirmation de suppression</h3>
                <p>Êtes-vous sûr de vouloir supprimer définitivement le jeu <strong><?= htmlspecialchars($jeu->name ?? '') ?></strong> ? Cette action est irréversible.</p>
                
                <div >
                    <button type="button" class="btn-edit" onclick="fermerConfirmation()">Annuler</button>
                    
                    <a href="<?= site_url('ModifBD/suprimer/'.rtrim(strtr(base64_encode($jeu->name ?? ''), '+/', '-_'), '=')) ?>" class="btn-delete">
                        Oui, supprimer
                    </a>
                </div>
            </div>
        </dialog>

    <?php else: ?>
        <p class="error_message">Impossible de charger les données de ce jeu.</p>
    <?php endif; ?>
</div>


