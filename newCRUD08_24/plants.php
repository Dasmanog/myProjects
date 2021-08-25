<?php

//ONE TO MANY

//plants. id, name, is_yearling ,quantity
//plant id atkeliauja is GET'o. 


include('./uniquePlants.php');
// plants php pasiima uniqueplants reiksme, tada taikomas post metodas, 
//2. funckija iskvieciama atvaizdavimui all()
//3. 




if (isset($_POST['create'])) {
    store();
    header("location:./plants.php?id=" . $_POST['plant_id']);
    die;
}

if (isset($_POST['update'])) {
    update();
    header("location:./plants.php?id=" . $_POST['plant_id']);
    die;
}

if (isset($_POST['delete'])) { // mes ateinam i delete 
    destroy($_POST['delete']); //ivyksta istrynimas 
    header("location:./plants.php?id=" . $_POST['plant_id']); //ir tada jisai mus redirectina , ir jis is posto gali issitraukti posto plant id 
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
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        /*checkbox*/

        @supports (zoom:2) {

            input[type="radio"],
            input[type=checkbox] {
                zoom: 2;
            }
        }

        @supports not (zoom:2) {

            input[type="radio"],
            input[type=checkbox] {
                transform: scale(2);
                margin: 15px;
            }
        }
    </style>
</head>

<body>
    <a href="./index.php"></a>
    <div class="container">
        <a href="./">HOME</a>
        <form class="form" action="" method="POST">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">age</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="age" value="<?= (isset($plant)) ? $plant['age'] : "" ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">height</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="height" value="<?= (isset($plant)) ? $plant['height'] : "" ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">health</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="health" value="<?= (isset($plant)) ? $plant['health'] : "" ?>">
                </div>
            </div>
            <input type="hidden" name="plant_id" value="<?= $_GET['id'] ?>">
            <?php if (!isset($plant)) {
                echo '<button class="btn btn-primary" name="create" type="submit" > Pridėti augalą </button>';
            } else {
                echo '<button class="btn btn-info" type="submit" name="update" value="' . $plant['id'] . '">Atnaujinti augalą</button>';
            } ?>
        </form>



        <table class="table">
            <tr>
                <th>Id</th>
                <?php
                $all = all();
                if (isset($all->fetch_assoc()['name'])) {
                    echo "  <th>name</th>  ";
                }
                ?>
                <th>age</th>
                <th>height</th>
                <th>health</th>
                <th>edit</th>
                <th>delete</th>
            </tr>


            <?php $count = 0;
            foreach ($all as $plant) { ?>
                <tr>
                    <td> <?= ++$count . "/" . $plant['id']  ?> </td>
                    <?php
                    if (isset($plant['name'])) {
                        echo "<td>" . $plant['name'] . "</td>";
                    } ?>

                    <td> <?= $plant['age']  ?> </td>
                    <td> <?= $plant['height']  ?> </td>
                    <td> <?= $plant['health']  ?> </td>
                    <td>
                        <!-- reiktu sugalvoti kaip pasikoreguoti rodoma id, galima ji pervardinti ir kad jis atspindetu tam tikra reiksme.  -->
                        <a class="btn btn-success" href="?id=<?= $_GET['id'] ?> &edit=<?= $plant['id'] ?>">edit</a>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="plant_id" value="<?= $_GET['id'] ?>">
                            <button class="btn btn-danger" type="submit" name="delete" value="<?= $plant['id'] ?>">delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>