<?php

require_once "Pokemon.php";
require_once __DIR__ . "/../functions/helpers.php";

class FirePokemon extends Pokemon {

    public function __construct($name, $url, $hp, $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon);
    }

    public function attack(Pokemon $p, float $coeff) {
        $targetElement = getElement($p);

        if ($targetElement == "None") parent::attack($p, 1);
        elseif ($targetElement == "Plant") parent::attack($p, 2);
        else parent::attack($p, 0.5);
    }
}

class WaterPokemon extends Pokemon {

    public function __construct($name, $url, $hp, $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon);
    }

    public function attack(Pokemon $p, float $coeff) {
        $targetElement = getElement($p);

        if ($targetElement == "None") parent::attack($p, 1);
        elseif ($targetElement == "Fire") parent::attack($p, 2);
        else parent::attack($p, 0.5);
    }
}

class PlantPokemon extends Pokemon {

    public function __construct($name, $url, $hp, $attackPokemon) {
        parent::__construct($name, $url, $hp, $attackPokemon);
    }

    public function attack(Pokemon $p, float $coeff) {
        $targetElement = getElement($p);

        if ($targetElement == "None") parent::attack($p, 1);
        elseif ($targetElement == "Water") parent::attack($p, 2);
        else parent::attack($p, 0.5);
    }
}

?>