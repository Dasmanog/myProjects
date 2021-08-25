<?php

include('./DB.php');

if (isset($_POST['create'])) {
    store();
    header('location:./index.php');
    die;
}

if (isset($_POST['update'])) {
    update($_POST['update']);
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
    <title>Document</title>
    <style>
        body {
            background-color: gray;
            color: white;
        }

        a {
            text-decoration: none;
            color: black;
        }

    /*checkbox*/
@supports (zoom:2) {
    input[type="radio"],  input[type=checkbox]{
    zoom: 2;
    }
}
@supports not (zoom:2) {
    input[type="radio"],  input[type=checkbox]{
        transform: scale(2);
        margin: 15px;
    }
}
    </style>

</head>

<body>
    <form class="form" action="./index.php" method="POST">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pavadinimas</label>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control" value="<?= (isset($plant)) ? $plant['name'] : "" ?> ">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Vienmetis</label>
            <div class="col-sm-4">
                <input type="checkbox" name="is_yearling" <?php if (isset($plant) && $plant['is_yearling']) {echo 'checked';}?>>   
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kiekis</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="quantity" value="<?= (isset($plant)) ? $plant['quantity'] : "" ?>">
            </div>
        </div>
        <?php if (!isset($plant)) {
            echo '<button class="btn btn-info" name="create" type="submit">Pridėti augalą</button>';
        } else {
            echo '<button class="btn btn-info" name="update" type="submit" value="' . $plant['id'] . '">Atnaujinti augalą</button>';
        } ?>

    </form>

    <?php
    if (!isset($_GET['hide'])) { ?>
        <button class="btn btn-primary" type="submit"><a href="?hide">Slėpti</a></button>

        <table class="table table-form table-dark">

            <tr>
                <th>ID</th>
                <th>Pavadinimas</th>
                <th>Vienmetis</th>
                <th>Kiekis</th>
                <th>Augalai</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php $count = 0;
            foreach (all() as $plant) {
                $checked = 'checked';
                if (!$plant['is_yearling']) {
                    $checked = '';
                }
            ?>
                <tr>
                    <td> <?= ++$count . "/" . $plant['id'] ?></td>
                    <td><?= $plant['name'] ?></td>
                    <td>
                        <input type="checkbox" name="" id="" <?= $checked ?> disabled>
                    </td>
                    <td><?= $plant['quantity'] ?></td>
                    <td> <a class="btn btn-success" href="?edit=<?= $plant['id'] ?>">Augalai</a></td>
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
    <?php } else { ?>
        <button class="btn btn-primary" type="submit"><a href="?show">Rodyti</a></button>
    <?php } ?>
</body>

</html>