<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Liste des jeux</title>
    </head>

    <body>
        
        <h1>Liste des jeux</h1>
        <table>
            <tr>
                <th>Nom</th>
                <th>Année</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Windows</th>
                <th>Linux</th>
                <th>Mac</th>
                <th>Metacritic</th>
                <th>Développeur</th>
                <th>Genres</th>
                <th>Catégories</th>
                <th>Poster</th>
            </tr>
            <?php foreach($jeuxposible as $jeu): ?>
                <?php if (empty($jeuxposible)): ?>
                <p>Jeux non trouve <p>
                <?php endif; ?>
                <tr>
                    <td><?= $jeu->name ?></td>
                    <td><?= $jeu->releaseYear ?></td>
                    <td><?= $jeu->shortDescription ?></td>
                    <td><?= $jeu->price ?></td>
                    <td><?= $jeu->windows ?></td>
                    <td><?= $jeu->linux ?></td>
                    <td><?= $jeu->mac ?></td>
                    <td><?= $jeu->metacritic ?></td>
                    <td><?= $jeu->developer_name ?></td>
                    <td><?= $jeu->genres ?></td>
                    <td><?= $jeu->categories ?></td>
                    <td>
                        <?php if(!empty($jeu->poster_jpeg)): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($jeu->poster_jpeg) ?>">
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        </table>

    </body>

</html>
