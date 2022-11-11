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
    <title>Delete Lecture</title>
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
            margin-top: 3%;
            margin-left: 2%;
            margin-right: 2%;
            max-width: 96%;
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
    <form action="deleteLecture.php" method="GET">
        <label for="Confirm deletion">Are you sure you want to delete this lecture?</label>
        <br />
        <button type="submit" class="btn btn-primary" name="confirm" value="<?php echo $_GET['slno'] ?>">CONFIRM</button>
        <button type="button" class="btn btn-primary" onclick="redirectFunction('teacherView.php')">CANCEL</button>
    </form>
    <?php
    if (isset($_GET['confirm']) == true) {
        $slno = $_GET['confirm'];
        try {   //Initiating database connection
            $conn = new mysqli("localhost", $dbUsername, $dbPassword, $dbName);
        } catch (Exception $e) {
            echo '<div class="alert alert-danger alert-box" role="alert">Cannot connect to database. Error: ' . $conn->connect_error . '</div>';
            exit(0);
        }
        $sql1 = "SELECT video FROM lecturelinks WHERE slno='$slno'";
        $result = $conn->query($sql1);
        $row = $result->fetch_assoc();
        $sql2 = "DELETE FROM lecturelinks WHERE slno='$slno'";
        if ($conn->query($sql2) == true && unlink($row['video']) == true) {
            echo '<div class="alert alert-success alert-box" role="alert">Lecture deleted</div>';
            exit(1);
        } else {
            echo '<div class="alert alert-warning alert-box" role="alert">Lecture was not deleted!</div>';
            echo '<script>
            setTimeout(()=>redirectFunction("deleteLecture.php"), 2000);
            </script>';
        }
        $conn->close();     //Closing database connection                
    }
    ?>
    <!-- form end -->
</body>

</html>