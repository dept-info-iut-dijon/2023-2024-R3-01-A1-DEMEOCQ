<h1>Recherche Pokémon</h1>
<div class="containerForm">
    <?php include('message.php'); ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="recherche">Rerchercher</label>
            <input type="text" name="recherche" id="recherche" class="form-control"<?php if($data !== null) echo " value='{$data['recherche']}'"; ?> required>
        </div>
        <div class="form-group">
            <label for="champ">Dans le champ</label>
            <select id="champ" name="champ" class="form-control">
                <?php foreach ($champs as $champ): ?>
                    <option value="<?= $champ->name ?>"<?php if($data !== null) if ($data['champ'] == $champ->name) echo " selected"; ?>><?= $champ->name ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Rechercher">
        </div>
    </form>

    <div class="pokemons">
        <?php if(!empty($pokemons)):
            foreach ($pokemons as $pokemon): ?>
                <article class="pokemon">
                    <div class="infos">
                        <h2>#<?= $pokemon->getIdPokemon() ?> - <?= $pokemon->getNomEspece() ?></h2>
                        <div class="">
                            <?= "<span class=''>{$pokemon->getTypeOne()}</span>" ?>
                            <?php if($pokemon->getTypeTwo() != null) echo "<span class=''>{$pokemon->getTypeTwo()}</span>"; ?>
                        </div>
                        <p><?= $pokemon->getDescription() ?></p>
                    </div>
                    <div>
                        <img src="<?= $pokemon->getUrlImg() ?>" alt="_">
                    </div>
                    <div class="actions">
                        <a href="/index.php?action=edit-pokemon&idPokemon=<?= $pokemon->getIdPokemon() ?>" class="btn btn-danger">Modifier</a>
                        <a href="/index.php?action=del-pokemon&idPokemon=<?= $pokemon->getIdPokemon() ?>" class="btn btn-primary">Supprimer</a>
                    </div>
                </article>
            <?php endforeach;
        elseif ($data !== null): ?>
            <p>Aucun Pokemon trouver pour : <?= $data['recherche'] ?> dans <?= $data['champ'] ?>.</p>
        <?php endif ?>
    </div>

</div>
