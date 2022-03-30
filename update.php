<?php
session_start();
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$backBtn = '';
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "home.php";
}
//if it is a adm it will create a back button to dashboard.php
if (isset($_SESSION["adm"])) {
    $backBtn = "dashboard.php";
}

$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$rowe = mysqli_fetch_array($res, MYSQLI_ASSOC);

//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $date_birth = $data['date_of_birth'];
        $picture = $data['picture'];
    }
}

//update
$class = 'd-none';
if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $id = $_POST['id'];
    //variable for upload pictures errors is initialized
    $uploadError = '';
    $pictureArray = file_upload($_FILES['picture']); //file_upload() called
    $picture = $pictureArray->fileName;
    if ($pictureArray->error === 0) {
        ($_POST["picture"] == "avatar.png") ?: unlink("pictures/{$_POST["picture"]}");
        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', date_of_birth = '$date_of_birth', picture = '$pictureArray->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', date_of_birth = '$date_of_birth' WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === true) {
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption - Edit User</title>
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" href="style/style.css">
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
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
        <div class="<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
        </div>
        <h2>Update</h2>
        <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $data['picture'] ?>' alt="<?php echo $f_name ?>">
        <form method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>First Name</th>
                    <td><input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name ?>" /></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email ?>" /></td>
                </tr>
                <tr>
                    <th>Date of birth</th>
                    <td><input class="form-control" type="date" name="date_of_birth" placeholder="Date of birth" value="<?php echo $date_birth ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                    <td><button name="submit" class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="<?php echo $backBtn ?>"><button class="btn btn-warning" type="button">Back Home</button></a></td>
                </tr>
            </table>
        </form>
    </div>
    <div>
        <p class="text-center m-5">Copyright 2022 &copy; Adrian Pedziwiatr</p>
    </div>
</body>
</html>