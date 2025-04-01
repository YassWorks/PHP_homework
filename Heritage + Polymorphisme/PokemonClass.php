<?php

class AttackPokemon {
    public int $attackMinimal;
    public int $attackMaximal;
    public int $specialAttack;
    public int $probabilitySpecialAttack;

    public function __construct($attackMinimal,
                                $attackMaximal,
                                $specialAttack,
                                $probabilitySpecialAttack) {
        $this->attackMinimal = $attackMinimal;
        $this->attackMaximal = $attackMaximal;
        $this->specialAttack = $specialAttack;
        $this->probabilitySpecialAttack = $probabilitySpecialAttack;                         
    }
}

class Pokemon {
    private string $name;
    private string $url;
    private int $hp;
    private AttackPokemon $attackPokemon;

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    public function isDead() {
        return $this->hp <= 0 ;
    }

    public function attack(Pokemon $p) {
        $oldHp = $p->getHp();
        $rand = mt_rand(0, 99);
        $special = $rand < $this->attackPokemon->probabilitySpecialAttack;

        $newHp = 0;
        if ($special) {
            $newHp = $oldHp - mt_rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal) * $this->attackPokemon->specialAttack;
        } else {
            $newHp = $oldHp - mt_rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
        }
        $p->setHp(max($newHp, 0));
    }

    // getters and setters
    public function getName() {
        return $this->name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getHp() {
        return $this->hp;
    }

    public function getAttackPokemon() {
        return $this->attackPokemon;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setHp($hp) {
        $this->hp = $hp;
    }

    public function setAttackPokemon(AttackPokemon $attackPokemon) {
        $this->attackPokemon = $attackPokemon;
    }

}

?>