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
    <title>Attempt Test</title>

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
    <!-- questions start -->
    <form action="attemptTest.php" method="POST">
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
        echo '<textarea class="form-control form-field" rows="3" placeholder="Answer" name="studentanswer[]" required="required"></textarea>';
    }
    ?>
    <button type="submit" class="btn btn-primary form-field" name="submit-test">SUBMIT TEST</button>
    </form> 
    <!-- questions end -->
    <!-- upload student answer start -->
    <?php
    if(isset($_POST['submit-test']) == true){        
        $studentAnswer = $_POST['studentanswer'];
        $query2 = "SELECT quesnos FROM testdetails WHERE testid='$testId'";
        $result = $conn->query($query2);
        $row = $result->fetch_assoc();
        $quesNos = $row['quesnos'];
        $query3 = "UPDATE questions SET studentanswer=? WHERE testid=? AND questionid=?";
        $stmt = $conn->prepare($query3);     //Creating prepared statement
        $stmt->bind_param("sii", $b1, $b2, $b3);
        for($i = 0; $i < $quesNos; $i += 1){
            $b1 = $studentAnswer[$i];
            $b2 = $testId;
            $b3 = $i + 1;
            $stmt->execute();
        }
        $stmt->close();     //Closing prepared statement
        $conn->close();     //Closing database connection
        echo '<script>
            location.href = "resultPage.php";
        </script>';
    }
    ?>
    <!-- upload student answer end -->
</body>

</html>