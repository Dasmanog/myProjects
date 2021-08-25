<?php

function connect()
{
    return new mysqli("localhost", "root", "", "physics");
}

function find($id)
{
    $conn = connect();
    $sql = 'SELECT * from `element` where id ='.$id;
    $result = $conn->query($sql);
    $conn->close();
    return $result->fetch_assoc();
}

function all()
{
    $conn = connect();
    $sql = "SELECT * FROM `element`";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}


function store()
{
    $conn = connect();
    $sql = 'INSERT INTO `element`(`id`, `name`, `attribute`, `mass`) VALUES (NULL,"'.$_POST['name'].'","'.$_POST['attribute'].'","'.$_POST['mass'].'")';
    $conn->query($sql);
    $conn->close();
}

function update()
{
    $conn = connect();
    $sql = 'UPDATE `element` SET `name`="' . $_POST['name'] . '",`attribute`="' . $_POST['attribute'] . '",`mass`="' . $_POST['mass'] . '" WHERE id ="' . $_POST['update'] . '"';
    $conn->query($sql);
    $conn->close();
}

function destroy($id){
    $conn = connect();
    $sql = "DELETE FROM `element` WHERE id=$id";
    $conn->query($sql);
    $conn->close();
}