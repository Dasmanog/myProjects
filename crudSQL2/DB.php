<?php
function connect()
{
    return new mysqli("localhost", "root", "", "medziai");
}

function find($id)
{
    $conn = connect();
    $sql = 'SELECT * from `plants` where id =' . $id;
    $result = $conn->query($sql);
    $conn->close();
    return $result->fetch_assoc();
}

function all()
{
    $conn = connect();
    $sql = "SELECT * from `plants`";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function store()
{
    $is_yearling = "0";
    if (isset($_POST['is_yearling'])) {
        $is_yearling = "1";
    }
    $conn = connect();
    $sql = 'INSERT INTO `plants`(`id`, `name`, `is_yearling`, `quantity`) VALUES (NULL,"' . $_POST['name'] . '","' . $is_yearling . '","' . $_POST['quantity'] . '")';
    $conn->query($sql);
    $conn->close();
}

function update($id)
{
    $conn = connect();
    $name = $_POST['name'];
    if ($_POST['is_yearling']) {
        $is_yearling = true;
    }
    $quantity =  $_POST['quantity'];
    $sql = "UPDATE `plants` SET name= '$name', is_yearling= '$is_yearling', quantity= '$quantity' WHERE id = '$id'";
    $conn->query($sql);
    $conn->close();
}

function destroy($id)
{
    $conn = connect();
    $sql = "DELETE FROM `plants` WHERE id=$id";
    $conn->query($sql);
    $conn->close();
}
