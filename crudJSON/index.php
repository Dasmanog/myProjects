<?php
include('./jsonData.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['action'] == 'create') {
        store();
        header('location:./index.php');
        die;
    }

    if ($_POST['action'] == 'update') {
        update();
        header('location:./index.php');
        die;
    }

    if ($_POST['action'] == 'destroy') {
        destroy();
        header('location:./index.php');
        die;
    }
}

$action = 'create';

if (isset($_GET['action'])) {
    $chemistry = edit();
    $action = 'update';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title> Periodinė elementų lentelė </title>
    <style>
    a{
            text-decoration: none;
            color: black;
        }
        </style>
</head>

<body>
    <form class="form" action="" method="POST">
        <input type="hidden" name="action" value="<?=$action?>">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pavadinimas</label>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control" value="<?=(isset($chemistry))?$chemistry['name']:""?> ">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Atominis skaičius(protonų skaičius)</label>
            <div class="col-sm-4">
                <input type="text" name="number" class="form-control" value=" <?= (isset($chemistry)) ? $chemistry['number'] : "" ?> ">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Simbolis </label>
            <div class="col-sm-4">
                <input type="text" name="symbol" class="form-control" value="<?= (isset($chemistry)) ? $chemistry['symbol'] : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Santykinė atominė masė</label>
            <div class="col-sm-4">
                <input type="text" name="mass" class="form-control" value="<?=(isset($chemistry)) ? $chemistry['mass'] : "" ?>">
            </div>
        </div>


        <?php if (!isset($chemistry)) {
            // echo  '<input type="hidden" name="action" value="create">';
            echo  '<button class="btn btn-info" type="submit"> Pridėti cheminį elementą </button>';
        } else {
            // echo  '<input type="hidden" name="action" value="update">';
            echo  '<input type="hidden" name="id" value="'.$chemistry['id'].'">
    <button class="btn btn-info" type="submit"> Atnaujinti cheminį elementą </button>';
        } ?>
    </form>
    
    <?php if (!isset($_GET['hide'])) { ?>
        <button class="btn btn-success" type="submit"><a href="?hide">Slėpti</a></button>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Pavadinimas</th>
                <th>Atominis skaičius(protonų skaičius)</th>
                <th>Simbolis</th>
                <th>Santykinė atominė masė</th>
                <th>Keisti</th>
                <th>Trinti</th>
            </tr>

            <?php $count = 0;
            foreach (getData() as $chemistry) { ?>
                <tr>
                    <td><?=++$count."/".$chemistry['id']?></td>
                    <td><?= $chemistry['name'] ?></td>
                    <td><?= $chemistry['number'] ?></td>
                    <td><?= $chemistry['symbol'] ?></td>
                    <td><?= $chemistry['mass'] ?></td>
                    <td>
                        <a class="btn btn-warning" href="?id= <?= $chemistry['id'] ?>&action=update">Keisti</a>
                    </td>

                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $chemistry['id'] ?>">
                            <input type="hidden" name="action" value="destroy">
                            <button class="btn btn-danger" type="submit">Trinti</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <button class="btn btn-success" type="submit"><a href="?show">Rodyti</a></button>
    <?php } ?>
</body>

</html>