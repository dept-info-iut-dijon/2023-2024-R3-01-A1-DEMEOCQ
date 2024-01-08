<?php

namespace model;
require_once("model/Model.php");
require_once("model/Pokemon.php");

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

        // retourne le pokémon créé à l'instant
        return $res;
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
}