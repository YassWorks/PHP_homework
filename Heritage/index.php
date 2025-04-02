<?php
require_once './classes/AttackPokemon.php';
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
$pikachu = new Pokemon("Pikachu", "./assets/pokemon.png", 100, $pikachuAttack);

$charmanderAttack = new AttackPokemon(15, 25, 1.5, 20);
$charmander = new Pokemon("Charmander", "./assets/charmander.png", 120, $charmanderAttack);

echo barInfo("Les combattants", "primary");
echo infoCombattants($pikachu, $charmander);

$round = 1;
while (true) {
    echo barInfo("Round ".$round, "danger");

    $pikachu->attack($charmander);
    if ($charmander->isDead()) break;

    $charmander->attack($pikachu);
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
</body>
</html>
