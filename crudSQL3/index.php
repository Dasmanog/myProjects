<?php


include('./DB.php');

if (isset($_POST['create'])) {
    store();
    header("location:./index.php");
    die;
}

if (isset($_POST['update'])) {
    update();
    header("location:./index.php");
    die;
}

if (isset($_POST['delete'])) {
    destroy($_POST['delete']);
    header("location:./index.php");
    die;
}



$action = 'create';

if (isset($_GET['edit'])) {
    $element = find($_GET['edit']);
    $action = 'update';
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fizika</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<style>
    body{
        background-color:bisque;
        color: black;
    }
    a{
        color: black;
        text-decoration: none;
    }


</style>
</head>

<body>
    <form class="form" action="./index.php" method="POST">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pavadinimas</label>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control" value="<?= (isset($element)) ? $element['name'] : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Savybė</label>
            <div class="col-sm-4">
                <input type="text" name="attribute" class="form-control" value="<?= (isset($element)) ? $element['attribute'] : "" ?> ">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Masė</label>
            <div class="col-sm-4">
                <input type="text" name="mass" class="form-control" value="<?= (isset($element)) ? $element['mass'] : "" ?>">
            </div>
        </div>

        <?php if (!isset($element)) {
            echo '<button class="btn btn-info" name="create" type="submit">Pridėti elementą</button>';
        } else {
            echo '<button class="btn btn-info" name="update" type="submit" value= "'.$element['id'].'">Atnaujinti elementą</button>';
        } ?>

    </form>

    <?php 
    if (!isset($_GET['hide'])) { ?>
        <button class="btn btn-primary" type="submit"><a href="?hide">Slėpti</a></button>

        <table class="table table-dark table- stripped">

            <tr>
                <th>ID</th>
                <th>Pavadinimas</th>
                <th>Savybė</th>
                <th>Masė</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php $count = 0;
            foreach (all() as $element) { 
                ?>
                <tr>
                    <td><?= ++$count."/".$element['id'] ?> </td>
                    <td><?= $element['name'] ?></td>
                    <td><?= $element['attribute'] ?></td>
                    <td><?= $element['mass'] ?></td>
                    <td>
                        <a class="btn btn-warning" href="?edit<?= $element['id'] ?>">Keisti</a>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $element['id'] ?>">
                            <input type="hidden" name="action" value="destroy">
                            <button class="btn btn-danger" type="submit" name="delete" value="<?= $element['id'] ?>">Trinti</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <button type="submit" class="btn btn-primary "><a href="?show">Rodyti</a></button>
    <?php } ?>
</body>

</html>