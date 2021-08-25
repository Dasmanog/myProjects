<?php

include('./FunkcijosPIRMASCRUD.php');
//edit, kai sita suvedu, iskart pradeda kaupti i session duomenis. 
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $element = edit();
}

//update
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id'])) {
    echo "atejau";
    $element = update();
    // header("location:./PIRMASCRUD.php");
    // die;
}

//store 
if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['id'])) {
    store();
    header("location:./PIRMASCRUD.php");
    die;
}

//destroy 
if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['abbreviation'])) {
    destroy();
    header("location:./PIRMASCRUD.php");
    die;
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
    <title>SI vienetas</title>
</head>

<body>



    <form action="" method="POST" class="form">


        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pagrindinis dydis</label>

            <div class="col-sm-4">

                <input type="text" name="main_quantity" class="form-control" value="<?= (isset($element)) ? $element['main_quantity'] : "" ?>">

            </div>
        </div>




        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Simbolis</label>

            <div class="col-sm-4">

                <input type="text" name="symbol" class="form-control" value="<?= (isset($element)) ? $element['symbol'] : "" ?>">

            </div>
        </div>




        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pagrindinis SI vienetas</label>

            <div class="col-sm-4">

                <input type="text"  class="form-control" name="si" value="<?= (isset($element)) ? $element['si'] : "" ?>">
            </div>
        </div>




        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Santrumpa</label>

            <div class="col-sm-4">

                <input  class="form-control" type="text" name="abbreviation" value="<?= (isset($element)) ? $element['abbreviation'] : "" ?>">
            </div>
        </div>




        <!-- Mygtukas, kad atsivaizduotu, norint, kad jis atsivaizduotu pagal paskirti, reikia suvesti if cikla -->
        <?php if (!isset($element)) { //reikia paduoti button html koda kaip stringa ir kad ji skaitytu if kaip teksta ir isechointu.
            echo '<button class="btn btn-secondary" type="submit">Pridėti fizikinį dydį</button>';
        } else {
            echo '<input type="hidden" name="id" value="' . $element['id'] . ' ">
            <button class="btn btn-primary" type="submit">Atnaujinti fizikinį dydį</button>';
        } ?>
    </form>


    <!-- <h5>Pagrindiniai fizikiniai dydžiai</h5> -->
    <table class="table table-striped">
        <tr>
            <!--Čia viršutinis tekstas lentelėje, stulpeliu pavadinimai -->
            <th>ID</th>
            <th>Pagrindinis dydis</th>
            <th>Simbolis</th>
            <th>Pagrindinis Si vienetas</th>
            <th>Santrupa</th>
            <th>edit</th>
            <th>delete</th>
        </tr>


        <?php $count = 0;
        foreach ($_SESSION['physics'] as $element) { ?>
            <tr>
                <td> <?= ++$count . "/" . $element['id'] ?> </td>
                <td> <?= $element['main_quantity']  ?></td>
                <td> <?= $element['symbol'] ?></td>
                <td> <?= $element['si']  ?></td>
                <td> <?= $element['abbreviation'] ?></td>
                <td><a class="btn btn-info" href="?id=<?=$element['id']?>">edit</a></td>
                <td>

                    <form action="" method="post">

                        <input type="hidden" name="id" value="<?=$element['id']?>">

                        <button class="btn btn-warning" type="submit">delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>