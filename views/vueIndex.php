<section class="section_title">
    <h1>Pokédex de <?= $nomDresseur ?></h1>
    <article>
        <table class="styled-tab">
            <thead>
            <tr>
                <th>ID</th>
                <th>Pokemon</th>
                <th>Description</th>
                <th>Types</th>
                <th>Images</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($listPokemon as $pokemon): ?>
                    <tr>
                        <td class="tabIdPok"><b><?= $pokemon->getIdPokemon() ?></b></td>
                        <td class="tabEspecePok"><?= $pokemon->getNomEspece() ?></td>
                        <td class="tabDescriptionPok"><?= $pokemon->getDescription() ?></td>
                        <td class="tabTypesPok"><?= $pokemon->getTypeOne()." ".$pokemon->getTypeTwo() ?></td>
                        <td class="tabImgPok"><img src="<?= $pokemon->getUrlImg() ?>" alt="Un Pokemon"></td>
                        <td class="tabOptions">
                            <form action="" method="post"></form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </article>
</section>



