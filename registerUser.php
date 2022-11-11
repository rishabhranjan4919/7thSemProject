<?php
error_reporting(0);
$dbUsername = "root";
$dbPassword = "";
$dbName = "7thsemprojectdatabase";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register User</title>

    <!-- Meta tag start -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta tag end -->

    <!-- Bootstrap code start -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- Bootstrap code end -->

    <!-- css start -->
    <style>
        /* Font import start */
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100;300;400&display=swap');
        /* Font import end */

        * {
            font-family: 'Noto Sans Mono';
        }

        .alert-box {
            position: absolute;
            top: 6%;
            width: 96%;
            z-index: -1;
            margin-left: 2%;
        }

        form {
            margin-left: 2%;
            margin-right: 2%;
            margin-bottom: 2%;
            margin-top: 3%;
            width: 96%;
        }

        .form-wrapper * {
            margin-top: 1%;
        }

        #category-wrapper,
        #image-wrapper,
        #image-wrapper>input {
            margin-top: 0%;
        }

        .required-field {
            color: red;
        }
    </style>
    <!-- css end -->

    <!-- js start -->
    <script>
        function redirectFunction(loc) {
            window.location.href = loc;
        }
    </script>
    <!-- js end -->
</head>

<body>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">App-Name</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <!-- navbar end -->

    <!-- form start -->
    <form action="registerUser.php" method="POST" enctype="multipart/form-data" class="form-wrapper">
        <input class="form-control" type="text" placeholder="Name" name="name" maxlength="100" required="required" />
        <input class="form-control" type="text" placeholder="Id" name="id" required="required" />
        <input class="form-control" type="text" placeholder="Email" name="email" maxlength="100" required="required" />
        <div id="category-wrapper">
            <label for="Category">You are a: </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="category" value="0" />
                <label class="form-check-label" for="Category">Teacher</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="category" value="1" />
                <label class="form-check-label" for="Category">Student</label>
            </div>
        </div>
        <div class="mb-3" id="image-wrapper">
            <label for="Profile Picture" class="form-label">Profile Picture(Maximum file size: 500 KB)<span class="required-field">*</span></label>
            <input class="form-control" type="file" name="image" />
        </div>
        <input class="form-control" type="password" placeholder="Password" name="password" maxlength="15" required="required" />
        <input class="form-control" type="password" placeholder="Confirm password" name="confirm-password" maxlength="15" required="required" />
        <button type="submit" class="btn btn-primary" name="register">REGISTER</button>
        <button class="btn btn-primary" onclick="redirectFunction('index.php')">CANCEL</button>
    </form>
    <!-- form end -->

    <?php
    if (isset($_POST['register']) == true) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $category = $_POST['category'];
        $image = $_FILES['image']['name'];
        $password = $_POST['password'];
        $conPassword = $_POST['confirm-password'];
        if ($password != $conPassword) {    //If "password" and "confirm password" do not match
            echo '<div class="alert alert-warning alert-box" role="alert">Passwords do not match!</div>';
            exit(0);
        }
        if (empty($image) == true) {    //If no file is selected for upload
            echo '<div class="alert alert-warning alert-box" role="alert">No file selected for upload!</div>';
            exit(0);
        }
        if ($_FILES['image']['size'] > 500000) {      //If file size is above 500 kb
            echo '<div class="alert alert-warning alert-box" role="alert">Image size exceeded 500 kb!</div>';
            exit(0);
        }
        if ($category == null) {      //If no category is selected
            echo '<div class="alert alert-warning alert-box" role="alert">No category selected!</div>';
            exit(0);
        }
        $targetDir = "profile-picture/";
        $fileName = $targetDir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
        $image = $fileName;
        try {       //Initiating database connnection
            $conn = new mysqli("localhost", $dbUsername, $dbPassword, $dbName);
        } catch (Exception $e) {
            echo '<div class="alert alert-danger alert-box" role="alert">Cannot connect to database. Error: ' . $conn->connect_error . '.</div>';
            exit(0);
        }
        $sql = "INSERT INTO userdetails(id, name, email, image, password, category) VALUES('$id', '$name', '$email', '$image', '$password', '$category')";
        if ($conn->query($sql) == true) {
            echo '<div class="alert alert-success alert-box" role="alert">User added!</div>';
            exit(1);
        } else {
            echo '<div class="alert alert-warning alert-box" role="alert">User was not added! Please try again.</div>';
            echo '<script>
            setTimeout(()=>redirectFunction("registerUser.php"), 2000);
            </script>';
        }
        $conn->close();     //Closing database connection
    }
    ?>
</body>

</html>