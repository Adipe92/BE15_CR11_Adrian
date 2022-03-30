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
<html>

<head>
    <title>Edit Product</title>
    <?php require_once '../components/boot.php' ?>
    <link rel="stylesheet" href="../style/style.css">
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
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
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $aname ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><input class="form-control" type="text" name="aname" placeholder="Animal Name" value="<?php echo $aname ?>" /></td>
                </tr>
                <tr>
                    <th>Kind</th>
                    <td><input class="form-control" type="text" name="kind" placeholder="Animal Kind" value="<?php echo $kind ?>" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class="form-control" type="text" name="age" placeholder="Age" value="<?php echo $age ?>" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>
                    <select name="size" class="form-select" id="inputGroupSelect01">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                    </select>
                    </td>
                </tr>
                <tr>
                <tr>
                    <th>Hobbies</th>
                    <td><input class="form-control" type="text" name="hobbies" placeholder="Hobbies" value="<?php echo $hobbies ?>" /></td>
                </tr>
                <tr>
                    <th>Localization</th>
                    <td><input class="form-control" type="text" name="loca" placeholder="Localization" value="<?php echo $loca ?>" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class="form-control" type="text" name="breed" placeholder="Product Name" value="<?php echo $breed ?>" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><textarea class="form-control" aria-label="With textarea" name="txt" value="<?php echo $txt ?>"></textarea></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $data['picture'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>