<?php

namespace model;

class Pokemon
{
    private ?int $idPokemon;

    private string $nomEspece;

    private ?string $description;

    private string $typeOne;

    private ?string $typeTwo;

    private ?string $urlImage;

    /**
     * @return int|null l'id dans la BDD du Pokemon
     */
    public function getIdPokemon(): ?int
    {
        return $this->idPokemon;
    }

    /**
     * @param int|null $idPokemon l'id dans la BDD du Pokemon
     * @return void
     */
    public function setIdPokemon(?int $idPokemon): void
    {
        $this->idPokemon = $idPokemon;
    }

    /**
     * @return string le nom d'espèce du Pokemon
     */
    public function getNomEspece(): string
    {
        return $this->nomEspece;
    }

    /**
     * @param string $nomEspece le nom d'espèce du Pokemon
     * @return void
     */
    public function setNomEspece(string $nomEspece): void
    {
        $this->nomEspece = $nomEspece;
    }

    /**
     * @return string|null la description du Pokemon
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description la description du Pokemon
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string Le 1er type du Pokemon
     */
    public function getTypeOne(): string
    {
        return $this->typeOne;
    }

    /**
     * @param string $typeOne Le 1er type du Pokemon
     * @return void
     */
    public function setTypeOne(string $typeOne): void
    {
        $this->typeOne = $typeOne;
    }

    /**
     * @return string|null le 2ᵉ types du Pokemon
     */
    public function getTypeTwo(): ?string
    {
        return $this->typeTwo;
    }

    /**
     * @param string|null $typeTwo le 2ᵉ types du Pokemon
     * @return void
     */
    public function setTypeTwo(?string $typeTwo): void
    {
        $this->typeTwo = $typeTwo;
    }

    /**
     * @return string|null url de l'image
     */
    public function getUrlImage(): ?string
    {
        return $this->urlImage;
    }

    /**
     * @param string|null $urlImage url de l'image
     * @return void
     */
    public function setUrlImage(?string $urlImage): void
    {
        $this->urlImage = $urlImage;
    }

    /**
     * Remplace les valeurs de la classe par celles des données
     * @param array $donnees données
     * @return void
     * @author Louis Demeocq
     */
    public function hydrate(array $donnees): void
    {
        foreach ($donnees as $key => $value) {
            $method = "set" . ucfirst($key);
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}