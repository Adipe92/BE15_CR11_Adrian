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
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$sql = "SELECT * FROM animals";
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
          <h4 class=''>Name: " .$row['name']."</h4>
          <ul>
              <li>Kind: " .$row['kind']."</li>
              <li>Age: " .$row['age']."</li>
              <li>Size: " .$row['size']."</li>
              <li>Hobbies: " .$row['hobbies']."</li>
              <li>Location: " .$row['location']."</li>
              <li>Breed: " .$row['breed']."</li>
          </ul>
        </div>
        <div class='col-lg-4'>
        <p class='text-center'><a class='btn btn-block btn-secondary m-5' href=''>Read More</a></p>    
        <p class='text-center'><a class='btn btn-block btn-success' href=''>Adopt</a> </p>    
            </div>
            </div>

        <div class='container bg-light'>
        <div class='row'>
            <div class='col-3'>
                <div class='text-center'>
                    <img class='img-thumbnail width='100%' mt-3' src='pictures/" .$row['picture']."'>
                </div>
                <div class='m-4'>
                    <p>ISBN: " .$row['isbn_number']." </p>
                    <p>Type: " .$row['type_of']." </p>
                    <p>Publish Date: " .$row['publish_date']."</p>
                    <br>
                    <a href='update.php?id=" .$row['id']."'><button class='btn btn-primary btn-sm ms-4 mt-4 mb-4'
                    type='button'>Edit</button></a>
                    <a href='delete.php?id=" .$row['id']."'><button class='btn btn-danger btn-sm ms-2 mt-4 mb-4'
                    type='button'>Delete</button></a>
                </div>
            </div>
            <div class='col-9'>
                <div class='p-5'>
                   <h4>Name: " .$row['name']." </h4>
                    <h5 class='mt-3 mb-3'>Kind: " .$row['kind']."</h5>
                    <h4>Description: </h4>
                    <p>" .$row['txt']."</p>
                    <hr>
                    <p>Publisher: " .$row['publisher_name']."</p>
                    <p>Publisher Address: " .$row['publisher_address']."</p>
                </div>

            </div>
        </div>
    </div>";
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
    <title>Welcome - <?php echo $row['first_name']; ?></title>
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
              <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>"> 
           </div>
            <div class="ms-5 mt-5">
             <h3>Hi <?php echo $row['first_name']; ?></h3> 
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
            <h3 class="m-5 text-center">Our pets for adoption</h3>
            <table class="table table-striped">
                <tbody>
                    <?= $tbody;?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>