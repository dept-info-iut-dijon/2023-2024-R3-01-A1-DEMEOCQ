<?php include('message.php'); ?>
<h1>Ajout un type de Pokémon</h1>
<div class="containerForm">
    <form action="" method="POST">
        <div class="form-group">
            <label for="nomType">Nom du type</label>
            <input type="text" name="nomType" id="nomType" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Ajouter le type">
        </div>
    </form>
</div>
