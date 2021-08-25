<?php
init();
function init()//1
{
    if (!file_exists('./data.txt')) {
        file_put_contents("./data.txt","[]");
        file_put_contents('./id.txt', 0);
    }
}

function edit(){
    foreach (getData() as $chemistry) {
       if ($chemistry['id'] == $_GET['id']) {
           return $chemistry;
       }
    }
}

function store(){
    $data = getData();

$chemistry['id'] = newId();
$chemistry['name'] = $_POST['name'];
$chemistry['number'] = $_POST['number'];
$chemistry['symbol'] = $_POST['symbol'];
$chemistry['mass'] = $_POST['mass'];

$data[] = $chemistry;
setData($data);
}


function getData(){//1.1
    $arr = json_decode(file_get_contents('./data.txt'),1);
    return $arr;
}

function setData($arr){//1.2
    file_put_contents('./data.txt', json_encode($arr));
}

function newId(){ //1.3
    $id = file_get_contents('./id.txt');
    $id++;
    file_put_contents('./id.txt', $id);
    return $id;
}

function destroy(){
    $data = getData();
    foreach ($data as $key => $chemistry) {
        if ($chemistry['id'] == $_POST['id']) {
            unset($data[$key]);
            setData($data);
            return;
        }
    }
}

function update(){
    $data= getData();
    foreach($data as &$element){
        if($element['id'] == $_POST['id']){
            $element['name'] = $_POST['name'];
            $element['number'] = $_POST['number'];
            $element['symbol'] = $_POST['symbol'];
            $element['mass'] = $_POST['mass'];
            setData($data);
            return;
        }
    }
}