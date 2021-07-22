<?php

function section_active($seccion = 'home'){
    $sec = $_GET['seccion'] ?? 'home';
    return ($seccion  == $sec) ? 'active' : '';
}

function stock($valor){
    $sinstock = 0;
    $valor = ($valor == $sinstock) ? 'Sin stock' :  $valor . ' en stock';
    return $valor;
}

function dd2($valor){
    echo '<pre>';
    var_dump($valor);
    echo '</pre>';
}