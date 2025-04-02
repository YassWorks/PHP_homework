<?php
function barInfo($content, $color){
    return '<div class="alert alert-'.$color.' mt-3" role="alert">'.$content.'</div>';
}

function infoCombattants($p1, $p2){
    return '
    <div class="d-flex flex-row align-items-center gap-4 justify-content-around">
        ' . $p1->whoAmI() . '
        ' . $p2->whoAmI() . '
    </div>';
}
?>
