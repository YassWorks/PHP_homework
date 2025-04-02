<?php
class AttackPokemon {
    private $attackMinimal;
    private $attackMaximal;
    private $specialAttack;
    private $probabilitySpecialAttack;

    public function __construct($min, $max, $special, $probability) {
        $this->attackMinimal = $min;
        $this->attackMaximal = $max;
        $this->specialAttack = $special;
        $this->probabilitySpecialAttack = $probability;
    }

    public function getAttackMinimal() { return $this->attackMinimal; }
    public function getAttackMaximal() { return $this->attackMaximal; }
    public function getSpecialAttack() { return $this->specialAttack; }
    public function getProbabilitySpecialAttack() { return $this->probabilitySpecialAttack; }
}
?>
