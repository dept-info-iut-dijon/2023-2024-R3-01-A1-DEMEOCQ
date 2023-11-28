<?php

namespace model;
require_once("model/Model.php");
require_once("model/Pokemon.php");

class PokemonManager extends Model
{
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