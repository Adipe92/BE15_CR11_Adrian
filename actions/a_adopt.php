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


if ($_POST) {
    $id = $_POST['id'];
    $aname = $_POST['aname'];
    $kind = $_POST['kind'];
    $loca = $_POST['loca'];
    $breed = $_POST['breed'];
    $txt = $_POST['txt'];
    $uploadError = '';



    $sql = "INSERT INTO pet_adoption(id) VALUES ('$id')";
    

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $aname </td>
            <td> $kind </td>
            </tr></table><hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption - Welcome - <?php echo $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" href="style/style.css">
    <style>
        .userImage {
            width: 220px;
            height: 300px;
        }
    </style>
</head>

<body>
<div class="header-img">
        <div class="header-text">
      <h1 class="title mb-3">Pet Adoption</h1>
      <p>Welcome to your profile account!</p>
       <div class="d-flex mt-5">
           <div>
              <img class="userImage" src="pictures/<?php echo $rowe['picture']; ?>" alt="<?php echo $rowe['first_name']; ?>"> 
           </div>
            <div class="ms-5 mt-5">
             <h3>Hi <?php echo $rowe['first_name']; ?></h3> 
            <hr>
            <p class="mt-5"><a class="btn btn-block btn-secondary" href="logout.php?logout">Sign Out</a></p>
            <p><a class="btn btn-block btn-secondary" href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a> </p>    
            </div>
                
    </div>
    </div>
    </div>
  </div>
  
  <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
    <div>
        <p class="text-center m-5">Copyright 2022 &copy; Adrian Pedziwiatr</p>
    </div>
</body>
</html>