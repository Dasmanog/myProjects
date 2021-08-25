<?php
function connect()
{
    return new mysqli("localhost", "root", "", "medelynass");
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
    $conn = connect();
    $sql = 'INSERT INTO `plants`(`id`,`name`,`is_yearling`,`quantity`) VALUES(NULL, "' . $_POST['name'] . '","' . $_POST['is_yearling'] . '","' . $_POST['quantity'] . '")';
    $conn->query($sql);
    $conn->close();
}

function update()
{
    $conn = connect();
    $sql = 'UPDATE  `plants` SET `name`="' . $_POST['name'] . '",`is_yearling`="' . $_POST['is_yearling'] . '",`quantity`="' . $_POST['quantity'] . '" WHERE id="' . $_POST['update'] . '"';
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
