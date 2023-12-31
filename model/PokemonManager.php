<?php

namespace model;
require_once("model/Model.php");
require_once("model/Pokemon.php");

/**
 * Manager Pokemon
 */
class PokemonManager extends Model
{

    /**
     * Crée un pokémon dans la bd
     * @param Pokemon $pokemon Pokémon à créer
     * @return Pokemon|false Pokémon créé ou faux si échoué
     */
    public function createPokemon(Pokemon $pokemon): Pokemon|false
    {
        $res = false;
        if($pokemon->getTypeTwo() === $pokemon->getTypeOne()) $pokemon->setTypeTwo(null);

        $sql = "INSERT INTO pokemon (nomEspece, description, typeOne, typeTwo, urlImg) VALUES (?, ?, ?, ?, ?);";
        if($this->execRequest($sql, [
            $pokemon->getNomEspece(),
            $pokemon->getDescription(),
            $pokemon->getTypeOne(),
            $pokemon->getTypeTwo(),
            $pokemon->getUrlImg()
        ])) {
            $idPokemon = $this->execRequest("SELECT LAST_INSERT_ID()")->fetch()[0];
            $pokemon->setIdPokemon($idPokemon);
            $res = $pokemon;
        }
        return $res;
    }

    /**
     * supprime le pokemon de la bdd
     * @param int $idPokemon
     * @return int
     */
    public function deletePokemon(int $idPokemon = -1): int
    {
        $sql = "DELETE FROM pokemon WHERE idPokemon = ?";
        $params = [$idPokemon];
        return $this->execRequest($sql, $params)->rowCount();
    }

    public function getAll() : array
    {
        $result = $this->execRequest("SELECT * FROM POKEMON");
        $pok_array = array();
        foreach($result->fetchAll() as $pok)
        {
            $pok_objet = new Pokemon();
            $pok_objet->hydrate($pok);
            $pok_array[] = $pok_objet;
        }
        return $pok_array;
    }

    /**
     * Modifie un pokémon en bdd
     * @param array $dataPokemon Données du pokémon à modifier
     * @return bool Vrai si le pokémon a été modifié, faux sinon
     */
    public function editPokemon(array $dataPokemon): bool
    {
        $res = false;
        if($dataPokemon["typeTwo"] === $dataPokemon["typeOne"]) $dataPokemon["typeTwo"] = null;

        $sql = "UPDATE pokemon SET nomEspece = ?, description = ?, typeOne = ?, typeTwo = ?, urlImg = ? WHERE idPokemon = ?;";
        if($this->execRequest($sql, [
            $dataPokemon["nomEspece"],
            $dataPokemon["description"],
            $dataPokemon["typeOne"],
            $dataPokemon["typeTwo"] === "null" ? null : $dataPokemon["typeTwo"],
            $dataPokemon["urlImg"],
            $dataPokemon["idPokemon"]
        ])) $res = true;

        return $res;
    }

    public function getById(int $idPokemon) : ?Pokemon
    {
        $result = $this->execRequest("SELECT * FROM POKEMON WHERE idPokemon=?", array($idPokemon))->fetch();
        if ($result != false){
            $pok = new Pokemon();
            $pok->hydrate($result);
        }
        else $pok = null;

        return $pok;
    }

    public function searchPokemons(array $params): array
    {
        $sql = match ($params['champ']) {
            'idPokemon' => "SELECT * FROM pokemon WHERE idPokemon LIKE ?",
            'nomEspece' => "SELECT * FROM pokemon WHERE nomEspece LIKE ?",
            'typeOne' => "SELECT * FROM pokemon WHERE typeOne LIKE ?",
            'typeTwo' => "SELECT * FROM pokemon WHERE typeTwo LIKE ?",
            'urlImg' => "SELECT * FROM pokemon WHERE urlImg LIKE ?",
            default => "SELECT * FROM pokemon WHERE description LIKE ?",
        };
        $params = ["%".$params["recherche"]."%"];
        $stmt = $this->execRequest($sql, $params);
        $res = $stmt->fetchAll();

        $pokemon_array= [];
        foreach($res as $pokemon){
            $pokemon_object = new Pokemon();
            $pokemon_object->hydrate($pokemon);
            $pokemon_array[] = $pokemon_object;
        }
        return $pokemon_array;
    }
}