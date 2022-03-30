<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$rowe = mysqli_fetch_array($res, MYSQLI_ASSOC);

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $aname = $data['aname'];
        $kind = $data['kind'];
        $loca = $data['loca'];
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
    <?php require_once 'components/boot.php' ?>
    <title>Animals Adoption - Add Animals</title>
    <link rel="stylesheet" href="style/style.css">
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
    <fieldset>
        <legend class='h2'>Add Animals</legend>
        <form action="actions/a_adopt.php" method="get" enctype="multipart/form-data">
            <table class='table mb-5'>
                <tr>
                    <th>Name</th>
                    <td><h6 name="aname"><?php echo $aname ?></h6></td>
                </tr>
                <tr>
                    <th>Kind</th>
                    <td><h6 name="kind"><?php echo $kind ?></h6></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><h6 name="loca"><?php echo $loca ?></h6></td>
                </tr>
                <tr>
                    <th>User</th>
                    <td><h6 name="loca"><?php echo $rowe['first_name']. $rowe[ 'last_name'] ?></h6></td>
                </tr>
                <tr>
                    <td><button class='btn btn-success' type="submit">Adopt</button></td>
                    <td><a href="index.php"><button class='btn btn-warning' type="button">No, back Home!</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
    <div>
        <p class="text-center m-5">Copyright 2022 &copy; Adrian Pedziwiatr</p>
    </div>
</body>
</html>