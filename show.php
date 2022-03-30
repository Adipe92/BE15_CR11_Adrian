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

// select logged-in users details - procedural style

$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$rowe = mysqli_fetch_array($res, MYSQLI_ASSOC);
$sql = "SELECT * FROM animals WHERE age > 8";
$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
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
        <p class='text-center'><a class='btn btn-block btn-secondary m-5' href='more.php?id=" .$row['id']."'>Read More</a></p>    
        <p class='text-center'><a class='btn btn-block btn-success' href=''>Adopt</a> </p>    
            </div>
            </div>
            <hr>";
    };
} else {
    $tbody =  "<tr><td colspan='10'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
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
        <hr>
        <br>
        <h1 class="text-center">Welcome to our home page of pet adoption.</h1>
        <br>
        <h6 class="text-center">Look and read about our pets!</h6>
        <br>
        <hr>
        <div class="mb-5">
        <p class="mt-5"><a class="btn btn-block btn-secondary" href="home.php">Showe All Animals</a></p>
            <h3 class="m-5 text-center">Our pets for adoption</h3>
            <table class="table table-striped">
                <tbody>
                    <?= $tbody;?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <p class="text-center m-5">Copyright 2022 &copy; Adrian Pedziwiatr</p>
    </div>
</body>
</html>