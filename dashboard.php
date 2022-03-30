<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);

//this variable will hold the body for the table
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= " 
        <div class='row p-3'>
        <div class='col-lg-3'>
          <div class='text-center'>
              <img src='pictures/" .$row['picture']."' alt='pic'>
          </div>
        </div>
        <div class='col-lg-4'>
          <h4 class=''>Name: " .$row['aname']."</h4>
          <ul>
              <li>Kind: " .$row['kind']."</li>
              <li>Age: " .$row['age']."</li>
              <li>Size: " .$row['size']."</li>
              <li>Hobbies: " .$row['hobbies']."</li>
              <li>Location: " .$row['loca']."</li>
              <li>Breed: " .$row['breed']."</li>
          </ul>
        </div>
        <div class='col-lg-4'>
        <p class='text-center'><a class='btn btn-block btn-secondary m-5' href='products/index.php'>Site Editor</a></p>       
            </div>
            </div>
            <hr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals Adoption - Dashboard</title>
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" href="style/style.css">
    <style type="text/css">
        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        td {
            text-align: left;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .userImage {
            width: 100px;
            height: auto;
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

    <div class="container mb-5">
        <div class="row">
            <div class="col-3 text-center">
                <img class="userImage" src="pictures/avatar.png" alt="Adm avatar">
                <p class="text-center"><b>Administrator</b></p>
                <a class="btn btn-success" href="products/index.php">Site Editor</a>
                <a class="btn btn-danger" href="logout.php?logout">Sign Out</a>
            </div>
            <div class="col-9 mt-2">

                <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <h1>Our Animals</h1>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        <p class="text-center m-5">Copyright 2022 &copy; Adrian Pedziwiatr</p>
    </div>
</body>
</html>