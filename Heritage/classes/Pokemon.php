<?php
require_once 'AttackPokemon.php';

class Pokemon {
    protected $name;
    protected $url;
    protected $hp;
    protected $attackPokemon;

    public function __construct($name, $url, $hp, $attackPokemon) {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    public function getName() { return $this->name; }
    public function getUrl() { return $this->url; }
    public function getHp() { return $this->hp; }
    public function getAttackPokemon() { return $this->attackPokemon; }
    public function setHp($hp) { $this->hp = max(0, $hp); }
    public function isDead() { return $this->hp <= 0; }

    public function attack(Pokemon $p) {
        $degat = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        $randP = rand(1, 100);
        if ($randP <= $this->attackPokemon->getProbabilitySpecialAttack()) {
            $degat *= $this->attackPokemon->getSpecialAttack();
        }
        $p->setHp($p->getHp() - $degat);
    }

    public function whoAmI() {
        return '
        <div class="card" style="width: 18rem;">
            <div class="card-header d-flex justify-content-around align-items-center">
                <div>' . $this->name . '</div>
                <img src="' . $this->url . '" alt="pokemon" class="img-thumbnail" style="width: 100px; height: 100px">
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Points : ' . $this->hp . '</li>
                <li class="list-group-item">Min Attack Points : ' . $this->attackPokemon->getAttackMinimal() . '</li>
                <li class="list-group-item">Max Attack Points : ' . $this->attackPokemon->getAttackMaximal() . '</li>
                <li class="list-group-item">Special Attack : ' . $this->attackPokemon->getSpecialAttack() . '</li>
                <li class="list-group-item">Probability Special Attack : ' . $this->attackPokemon->getProbabilitySpecialAttack() . '%</li>
            </ul>
        </div>';
    }
}
?>
