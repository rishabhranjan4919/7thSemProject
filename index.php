<?php
session_start();
error_reporting(0);
$dbUsername = "root";
$dbPassword = "";
$dbName = "7thsemprojectdatabase";
?>
<!doctype html>
<html>

<head>
    <title>Home</title>

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
        /* Font import code start */
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100;300;400&display=swap');
        /* Font import code end */

        * {
            font-family: 'Noto Sans Mono';
        }

        .alert-box {
            position: absolute;
            top: 5%;
            width: 96%;
            z-index: -1;
            margin-left: 2%;
        }

        form {
            width: 40%;
            transform: translate(75%, 140%);
            border: 1px solid black;
            border-radius: 3px;
        }

        .form-field {
            margin-left: 2%;
            margin-right: 2%;
            margin-top: 2%;
            width: 95%;
        }

        form button {
            margin-bottom: 2%;
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
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="registerUser.php">Register user</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- form start -->
    <form method="GET" action="index.php">
        <input class="form-control form-field" type="text" placeholder="Id" name="id" required="required">
        <input class="form-control form-field" type="password" placeholder="Password" name="password" maxlength="15" required="required">
        <div class="form-field">
            <label for="Category">You are a: </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="category" value="0">
                <label class="form-check-label" for="Teacher">Teacher</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="category" value="1">
                <label class="form-check-label" for="Student">Student</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary form-field" name="login">LOGIN</button>
    </form>
    <!-- form end -->

    <!-- login start -->
    <?php
    if (isset($_GET['login']) == true) {
        $id = $_GET['id'];
        $password = $_GET['password'];
        $category = $_GET['category'];
        if ($category == null) {
            echo '<div class="alert alert-warning alert-box" role="alert">
            Please select a category!
            </div>';
            exit(0);
        }
        try {   //Initiating database connection
            $conn = new mysqli("localhost", "$dbUsername", "$dbPassword", "$dbName");
        } catch (Exception $e) {
            echo '<div class="alert alert-danger alert-box" role="alert">
            Cannot connect to database. Error: ' . $conn->connect_error . '
            .</div>';
            exit(0);
        }
        $sql = "SELECT * FROM userdetails";
        $result = $conn->query($sql);
        $flag = 0;
        while ($row = $result->fetch_assoc()) {
            if ($id == $row['id'] && $password == $row['password'] && $category == $row['category']) {
                $flag = 1;
                break;
            }
        }
        if ($flag == 1) { //If login credentials are correct
            $_SESSION['id'] = $id;
            $_SESSION['category'] = $category;
            echo '<div class="alert alert-success alert-box" role="alert">
                        Logged in successfully!
                        </div>';
            if ($category == 0) {     //For teacher                
                echo '<script>
                    setTimeout(()=> redirectFunction("teacherView.php"), 2000);
                    </script>';
            } else if ($category == 1) {    //For student                                
                echo '<script>
                    setTimeout(()=> redirectFunction("studentView.php"), 2000);
                    </script>';
            }
        } else if ($flag == 0) {   //If login credentials are incorrect
            echo '<div class="alert alert-warning alert-box" role="alert">
            Incorrect credentials! Please try again.
            </div>';
            session_destroy();
            exit(0);
        }
        $conn->close();     //Closing database connection
    }
    ?>
    <!-- login end -->
</body>

</html>