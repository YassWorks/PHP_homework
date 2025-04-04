<?php
function barInfo($content, $color){
    return '<div class="alert alert-'.$color.' mt-3" role="alert">'.$content.'</div>';
}

function infoCombattants(...$pokemons) {
    $output = '<div class="d-flex flex-row align-items-center gap-4 justify-content-around">';
    foreach ($pokemons as $pokemon) {
        $output .= $pokemon->whoAmI();
    }
    $output .= '</div>';
    return $output;
}

function getElement($p) {
    $targetElement = ($p instanceof FirePokemon) ? "Fire":
                        (($p instanceof PlantPokemon) ? "Plant":
                        (($p instanceof WaterPokemon) ? "Water" : "None"));
    
    return $targetElement;
}
?>
