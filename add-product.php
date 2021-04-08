<?php
include 'protect.php';

if ( isset($_REQUEST["title"]) )
{
    $title = $_REQUEST["title"];
    $description = $_REQUEST["description"];
    $genre = $_REQUEST["genre"];

    $target_dir = "uploads/";//456789_kk.png
    $target_file = $target_dir . rand(1000000,10000000)."_".basename($_FILES["poster"]["name"]);
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));//png jpg
    if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
        //echo "Uploaded";
        $upload_status = 1;
    }
    require 'connect.php';
    $sql = "INSERT INTO `products`(`id`, `title`, `description`, `genre`, `poster`) 
                          VALUES (null,'$title','$description','$genre','$target_file')";
    mysqli_query($con, $sql) or die(mysqli_error($con));
    header("location:add-product.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'nav.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <h4>New Movie</h4>
            <form action="add-product.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description"  class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Genre</label>
                    <select name="genre"  class="form-control">
                        <option value="Thriller">Thriller Movie</option>
                        <option value="Comedy">Comedy Movies</option>
                        <option value="Horror">Horror Movie</option>
                        <option value="Action">Action Movie</option>
                        <option value="Romance">Romance Movie</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Poster</label>
                    <input type="file" accept="image/*" class="form-control-file border" name="poster" required>
                </div>



                <button class="btn btn-success">Add Movie</button>

            </form>
        </div>
    </div>
</div>



</body>
</html>

