<?php

include('./DB.php');

if (isset($_POST['create'])) {
    store();
    header('location:./index.php');
    die;
}

if (isset($_POST['update'])) {
    update();
    header('location:./index.php');
    die;
}

if (isset($_POST['delete'])) {
    destroy($_POST['delete']);
    header('location:./index.php');
    die;
}

$action = 'create';

if (isset($_GET['edit'])) {
    $plant = find($_GET['edit']);
    $action = 'update';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Medelynas</title>
    <style>
        body {
            background-color:grey;
            color: white;
        }
        a{
            text-decoration:none;
            color:black;
        }
    </style>
</head>

<body>
    <form class="form" action="./index.php" method="POST">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pavadinimas</label>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control" value="<?= (isset($plant)) ? $plant['name'] : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Vienmetis</label>
            <div class="col-sm-4">
                <input type="text" name="is_yearling" class="form-control" value="<?= (isset($plant)) ? $plant['is_yearling'] : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kiekis</label>
            <div class="col-sm-4">
                <input type="text" name="quantity" class="form-control" value="<?= (isset($plant)) ? $plant['quantity'] : "" ?>">
            </div>
        </div>
        <?php if (!isset($plant)) {
            echo  '<button type="submit" class="btn btn-info" name="create">Pridėti augalą</button>';
        } else {
            echo '<button type="submit" class="btn btn-info" name="update" value="' . $plant['id'] . '">Atnaujinti augalą</button>';
        } ?>
    </form>

    <?php
    if (!isset($_GET['hide'])) { ?>
        <button class="btn btn-primary" type="submit"><a href="?hide">Slėpti</a></button>

        <table class="table table-form">

            <tr>
                <th>ID</th>
                <th>Pavadinimas</th>
                <th>Vienmetis</th>
                <th>Kiekis</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php $count = 0;
            foreach (all() as $plant) { ?>
                <tr>
                    <td> <?= ++$count."/".$plant['id']?></td>
                    <td><?= $plant['name'] ?></td>
                    <td><?= $plant['is_yearling'] ?></td>
                    <td><?= $plant['quantity'] ?></td>
                    <td>
                        <a class="btn btn-warning" href="?edit=<?= $plant['id'] ?>">Keisti</a>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $plant['id'] ?>">
                            <input type="hidden" name="action" value="destroy">
                            <button class="btn btn-danger" type="submit" name="delete" value="<?= $plant['id'] ?>">Trinti</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else{ ?>
        <button class="btn btn-primary" type="submit"><a href="?show">Rodyti</a></button>
        <?php } ?>
</body>

</html>