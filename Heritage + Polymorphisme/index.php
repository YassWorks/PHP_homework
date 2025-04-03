<?php
require_once './classes/AttackPokemon.php';
require_once './classes/ElementPokemonsClasses.php';
require_once './classes/Pokemon.php';
require_once './functions/helpers.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokemon Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<?php

$pikachuAttack = new AttackPokemon(10, 20, 2, 30);
$pikachu = new Pokemon("Pikachu", "./assets/pikachu.png", 100, $pikachuAttack);

$charmanderAttack = new AttackPokemon(15, 25, 1.5, 20);
$charmander = new Pokemon("Charmander", "./assets/charmander.png", 120, $charmanderAttack);

echo barInfo("Les combattants", "primary");
echo infoCombattants($pikachu, $charmander);

$round = 1;
while (true) {
    echo barInfo("Round ".$round, "danger");

    $pikachu->attack($charmander, 1);
    if ($charmander->isDead()) break;

    $charmander->attack($pikachu, 1);
    if ($pikachu->isDead()) break;

    echo infoCombattants($pikachu, $charmander);
    $round++;
}

echo barInfo("Combat terminé !", "light");

if ($pikachu->isDead()) {
    echo barInfo($charmander->getName() . " remporte la victoire !", "success");
} else {
    echo barInfo($pikachu->getName() . " remporte la victoire !", "success");
}
?>





<?php

$InfernapeAttack  = new AttackPokemon(10, 25, 1.75, 50);
$Infernape = new FirePokemon("Infernape", "./assets/infernape.jpg", 76, $InfernapeAttack);

$GreninjaAttack = new AttackPokemon(11, 18, 1.25, 40);
$Greninja = new WaterPokemon("Greninja", "./assets/greninja.jpg", 115, $GreninjaAttack);

$RillaboomAttack = new AttackPokemon(8, 22, 2, 35);
$Rillaboom = new PlantPokemon("Rillaboom", "./assets/rillaboom.jpg", 145, $RillaboomAttack);

echo "<br><br><br>";
echo barInfo("Les Pokemons spéciaux", "primary");
echo infoCombattants($Infernape, $Greninja, $Rillaboom);

echo barInfo("Premier combat", "primary");
echo infoCombattants($Infernape, $Greninja);
$round = 1;
while (true) {
    echo barInfo("Round ".$round, "danger");
    
    $Infernape->attack($Greninja, 1);
    if ($Greninja->isDead()) break;
    
    $Greninja->attack($Infernape, 1);
    if ($Infernape->isDead()) break;
    
    echo infoCombattants($Infernape, $Greninja);
    $round++;
}
echo barInfo("Combat terminé !", "light");
if ($Infernape->isDead()) {
    echo barInfo($Greninja->getName() . " remporte la victoire !", "success");
} else {
    echo barInfo($Infernape->getName() . " remporte la victoire !", "success");
}

$Infernape->setHp(76);
$Greninja->setHp(115);

echo "<br><br><br>";
echo barInfo("Deuxieme combat", "primary");
echo infoCombattants($Infernape, $Rillaboom);
$round = 1;
while (true) {
    echo barInfo("Round ".$round, "danger");

    $Infernape->attack($Rillaboom, 1);
    if ($Rillaboom->isDead()) break;

    $Rillaboom->attack($Infernape, 1);
    if ($Infernape->isDead()) break;

    echo infoCombattants($Infernape, $Rillaboom);
    $round++;
}
echo barInfo("Combat terminé !", "light");
if ($Infernape->isDead()) {
    echo barInfo($Rillaboom->getName() . " remporte la victoire !", "success");
} else {
    echo barInfo($Infernape->getName() . " remporte la victoire !", "success");
}

$Infernape->setHp(76);
$Rillaboom->setHp(145);

echo "<br><br><br>";
echo barInfo("Troisième combat", "primary");
echo infoCombattants($Greninja, $Rillaboom);
$round = 1;
while (true) {
    echo barInfo("Round ".$round, "danger");

    $Greninja->attack($Rillaboom, 1);
    if ($Rillaboom->isDead()) break;

    $Rillaboom->attack($Greninja, 1);
    if ($Greninja->isDead()) break;

    echo infoCombattants($Greninja, $Rillaboom);
    $round++;
}
echo barInfo("Combat terminé !", "light");
if ($Greninja->isDead()) {
    echo barInfo($Rillaboom->getName() . " remporte la victoire !", "success");
} else {
    echo barInfo($Greninja->getName() . " remporte la victoire !", "success");
}
?>
</body>
</html>
