<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>Animals Adoption - Add Animals</title>
    <link rel="stylesheet" href="../style/style.css">
    <style>
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }
    </style>
</head>

<body>
<div class="header-img">
        <div class="header-text">
      <h1 class="title mb-3">Pet Adoption</h1>
      <p>Welcome to your Admin account!</p>
       
                
    </div>
  </div>
    <fieldset>
        <legend class='h2'>Add Animals</legend>
        <form action="actions/a_create.php" method="post" enctype="multipart/form-data">
            <table class='table mb-5'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="aname" placeholder="Animal Name" /></td>
                </tr>
                <tr>
                    <th>Kind</th>
                    <td><input class='form-control' type="text" name="kind" placeholder="Kind of Animal" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" placeholder="Age" step="any" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>
                    <select name="size" class="form-select" id="inputGroupSelect01">
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Hobbies</th>
                    <td><input class='form-control' type="text" name="hobbies" placeholder="Hobbies" /></td>
                </tr>
                <tr>
                    <th>Localization</th>
                    <td><input class='form-control' type="text" name="loca" placeholder="Location" /></td>
                </tr>
                <tr>
                    <th>Bread</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="breed" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><textarea class="form-control" aria-label="With textarea" name="txt"></textarea></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" /></td>
                </tr>
                <tr>
                    <td><button class='btn btn-success' type="submit">Insert Animals</button></td>
                    <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
    <div>
        <p class="text-center m-5">Copyright 2022 &copy; Adrian Pedziwiatr</p>
    </div>
</body>
</html>