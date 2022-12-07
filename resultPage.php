<?php
session_start();
// error_reporting(0);
$dbUsername = "root";
$dbPassword = "";
$dbName = "7thsemprojectdatabase";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Result Page</title>

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

        table {
            margin-top: 3%;
            margin-left: 2%;
            margin-right: 2%;
            max-width: 96%;
            overflow: scroll;
        }
    </style>
    <!-- css end -->
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
                    <a class="nav-link" href="testDetails.php">Back</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- result start -->
    <?php
    try {   //Initiating database connection
        $conn = new mysqli("localhost", $dbUsername, $dbPassword, $dbName);
    } catch (Exception $e) {
        echo '<div class="alert alert-danger alert-box" role="alert">Cannot connect to database. Error: ' . $conn->connect_error . '</div>';
        exit(0);
    }
    $testId = $_SESSION['testid'];
    $query1 = "SELECT * FROM questions WHERE testid='$testId'";
    $result = $conn->query($query1);
    while ($row = $result->fetch_assoc()) {
        echo '<p>' . $row['question'] . '</p>';
        echo '<p>' . $row['studentanswer'] . '</p>';
        $command = escapeshellcmd('python main.py "' . $row['teacheranswer'] . '" "' . $row['studentanswer'] . '"');
        $output = shell_exec($command);
        echo '<p>Score: ' . $output . '%</p>';
    }
    $conn->close();     //Closing database connection
    ?>
    <!-- result end -->
</body>

</html>