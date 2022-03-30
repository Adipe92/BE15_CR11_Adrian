<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $aname = $data['aname'];
        $kind = $data['kind'];
        $picture = $data['picture'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Adoption - Delete Animal</title>
    <?php require_once '../components/boot.php' ?>
    <link rel="stylesheet" href="../style/style.css">
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 70%;
        }

        .img-thumbnail {
            width: 120px !important;
            height: 120px !important;
            margin-left: 20px;
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
        <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $aname ?>"></legend>
        <h5 class="mt-5 mb-5">You have selected animal below:</h5>
        <table class="table w-75 mt-3">
            <tr>
                <td><h4><?php echo $aname ?></h4></td>
            </tr>
        </table>

        <h3 class="mb-4">Do you really want to delete this animal?</h3>
        <form action="actions/a_delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="picture" value="<?php echo $picture ?>" />
            <button class="btn btn-danger" type="submit">Yes, delete it!</button>
            <a href="index.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
        </form>
    </fieldset>
    <div>
        <p class="text-center m-5">Copyright 2022 &copy; Adrian Pedziwiatr</p>
    </div>
</body>
</html>