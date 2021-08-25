<?php

init();

function init()
{
    session_start();
    if(!isset( $_SESSION['physics'])  ){

        $_SESSION['physics'] = [];
        $_SESSION['id'] = 1;
    }
}


//kai suvedu sita funkcija, tada pradeda kaupti duomenis sessione. 
function edit(){
    foreach($_SESSION['physics'] as $element){
        if ($element['id'] == $_GET['id']) {
            return $element;
        }
    }
}

function store(){

    $element['id'] = $_SESSION['id'];
    $element['main_quantity'] = $_POST['main_quantity'];
    $element['symbol'] = $_POST['symbol'];
    $element['si'] = $_POST['si'];
    $element['abbreviation'] = $_POST['abbreviation'];

$_SESSION['id']++;

$_SESSION['physics'][] = $element;
}


function destroy(){

    foreach ($_SESSION['physics'] as $key => $element) {

        if ($element['id'] == $_POST['id']) {
            unset($_SESSION['physics'][$key]);
            return;
        }
    }
}





function update(){
    foreach($_SESSION['physics'] as &$element){
        if ($element['id'] == $_POST['id']) {
            $element['main_quantity'] == $_POST['main_quantity'];
            $element['symbol'] == $_POST['symbol'];
            $element['si'] == $_POST['si'];
            $element['abbreviation'] == $_POST['abbreviation'];
       return;
        }
    }
}
?>