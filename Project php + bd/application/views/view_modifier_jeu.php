<link rel="stylesheet" href="<?= base_url('assets/styles/pageJeuxStyle.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/styles/pageModifStyle.css') ?>">
<script src="<?= base_url('assets/scripts/ajouterGenreOuCategories.js') ?>"></script>

<div class="game-wrapper">
    
    <?php if (!empty($jeu) && $jeu->name !== ""): ?>
        <form action="<?= site_url('ModifBD/valider/'.rtrim(strtr(base64_encode($jeu->name), '+/', '-_'), '=')) ?>" method="post" class="form-box">
    <?php elseif (!empty($jeu) && $jeu->name === ""): ?>
        <form action="<?= site_url('ModifBD/valider_ajouter/') ?>" method="post" class="form-box">
    <?php endif; ?>
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
                    <h3 class="game_title">Modifier les informations</h3>

                    <div class="form-group">
                        <span class="section_title">Nom du jeu :</span>
                        <input type="text" name="nom_jeu" value="<?= htmlspecialchars($jeu->name ?? '') ?>" required>
                    </div>

                    <div class="metacritic">
                        <span class="section_title">Note Metacritic :</span>
                        <input type="number" name="note_metacritic" min="0" max="100" value="<?= $jeu->metacritic ?? '' ?>">
                        <label class="checkbox-label">
                            <input type="checkbox" name="metacritic_null"> Pas de note
                        </label>
                    </div>

                    <div class="form-group">
                        <span class="section_title">Année :</span>
                        <input type="text" name="anne" value="<?= htmlspecialchars($jeu->releaseYear ?? '') ?>">
                    </div> 

                    <div class="platform_container">
                        <span class="section_title">Plateformes disponibles :</span>
                        <div class="badge_list">
                            <label class="platform_badge">
                                <input type="checkbox" name="check_windows" value="1" <?= ($jeu->windows == 1) ? 'checked' : '' ?>> Windows
                            </label>
                            
                            <label class="platform_badge">
                                <input type="checkbox" name="check_mac" value="1" <?= ($jeu->mac == 1) ? 'checked' : '' ?>> Mac
                            </label>
                            
                            <label class="platform_badge">
                                <input type="checkbox" name="check_linux" value="1" <?= ($jeu->linux == 1) ? 'checked' : '' ?>> Linux
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="section_title">Developer :</span>
                        <input type="text" name="developer_jeu" value="<?= htmlspecialchars($jeu->developer_name ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <span class="section_title">Price :</span>
                        <input type="text" name="prix" value="<?= htmlspecialchars($jeu->price ?? '') ?>">
                    </div> 
                </div>
            </div>

            <div class="right_column">

                <div class="platform_container">
                    <span class="section_title">GENRES :</span>
                    <div class="badge_list" id="liste-genres">
                        <?php if (!empty($jeu->genres)): ?>
                            <?php $genresArray = explode(', ', $jeu->genres); ?>
                            <?php foreach ($genresArray as $genre) : ?>
                                <label class="platform_badge">
                                    <input type="checkbox" name="genres[]" value="<?= htmlspecialchars($genre) ?>" checked> <?= $genre ?>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div >
                            <select id="select-genres" class="platform_badge">
                                <option value=""> Choisir un genre </option>
                                <?php foreach($tous_les_genres as $genre): ?>
                                    <option value="<?= htmlspecialchars($genre->description) ?>"><?= $genre->description ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="platform_badge btn-ajoutement" onclick="ajouterDepuisSelect('genres')">+</button>
                        </div>
                    </div>
                </div>

                <div class="platform_container">
                    <span class="section_title">CATÉGORIES :</span>
                    <div class="badge_list" id="liste-categories">
                        <?php if (!empty($jeu->categories)): ?>
                            <?php $categoriesArray = explode(', ', $jeu->categories); ?>
                            <?php foreach ($categoriesArray as $category) : ?>
                                <label class="platform_badge">
                                    <input type="checkbox" name="categories[]" value="<?= htmlspecialchars($category) ?>" checked> <?= $category ?>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div>
                            <select id="select-categories" class="platform_badge">
                                <option value=""> Choisir une catégorie </option>
                                <?php foreach($toutes_les_categories as $categorie): ?>
                                    <option value="<?= htmlspecialchars($categorie->description) ?>"><?= $categorie->description ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="platform_badge btn-ajoutement" onclick="ajouterDepuisSelect('categories')" >+</button>
                        </div>
                    </div>
                </div>

                <div class="description_section">
                    <span class="section_title">Description :</span>
                    <textarea name="description_jeu" rows="5"><?= htmlspecialchars($jeu->shortDescription ?? '') ?></textarea>
                </div>

            </div>
            
        </div>
        <div class="action_container">
            <?php if (!empty($jeu) && !empty($jeu->name)): ?>
                <a href="<?= site_url('ModifBD/index/'.rtrim(strtr(base64_encode($jeu->name), '+/', '-_'), '=')) ?>" class="btn-edit">
                    Annuler
                </a>
            <?php else: ?>
                <a href="<?= site_url('GameBD/index') ?>" class="btn-edit">
                    Annuler
                </a>
            <?php endif; ?>
            
            <button type="submit" class="btn-delete">Enregistrer</button>
        </div>
    </form>

</div>
