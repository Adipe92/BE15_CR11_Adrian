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
        $age = $data['age'];
        $size = $data['size'];
        $hobbies = $data['hobbies'];
        $loca = $data['loca'];
        $breed = $data['breed'];
        $txt = $data['txt'];
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption - More about <? echo $row['aname']; ?></title>
    <link rel="stylesheet" href="style/style.css">
    <?php require_once 'components/boot.php' ?>
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
  <h3 class="text-center m-3">Read more about <?php echo $aname ?></h3>
  <br>
  <p class='text-center'><a class='btn btn-block btn-secondary' href='home.php'>Back</a> </p>
  <div class="container">
      <hr class="m-4">
    <div class="row">
      <div class="col-lg-4 text-center">
        <img src="pictures/<?php echo $picture ?>" alt="pic">
      </div>
      <div class="col-lg-8">
          <h3>Description</h3>
          <p><?php echo $txt ?></p>
          <br>
          <h4>Age: <?php echo $age ?> years old</h4>
          <br>
          <h4>Size: <?php echo $size ?></h4>
          <br>
          <h4>Breed: <?php echo $breed ?></h4>
          <br>
          <h4>Kind: <?php echo $kind ?></h4>
          <br>
          <h4>Location: <?php echo $loca ?></h4>
          <br>
          <h4>Hobbies: <?php echo $hobbies ?></h4>
      </div>
      <hr class="m-4">
      <h5 class="text-center m-3">Maybe you would like to adopt <?php echo $aname ?>?</h5>
      <br>
      <div class="d-flex justify-content-center">
      <p class='text-center ms-3 me-3'><a class='btn btn-block btn-success' href='#'>Yes, Take me home!</a> </p> 
      <p class='text-center'><a class='btn btn-block btn-danger' href='home.php'>No, Find another animal!</a> </p> 
      </div>
      
  </div>  
  </div>
  
<div>
        <p class="text-center m-5">Copyright 2022 &copy; Adrian Pedziwiatr</p>
    </div>
</body>
</html>