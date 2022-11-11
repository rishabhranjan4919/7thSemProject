<?php
session_start();
error_reporting(0);
$dbUsername = "root";
$dbPassword = "";
$dbName = "7thsemprojectdatabase";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Student View</title>

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
                    <a class="nav-link" href="viewProfile.php">View profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- table start -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Teacher's name</th>
                <th scope="col">Title</th>
                <th scope="col">Lecture</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {   //Initiating database connection
                $conn = new mysqli("localhost", $dbUsername, $dbPassword, $dbName);
            } catch (Exception $e) {
                echo '<div class="alert alert-danger alert-box" role="alert">
                Cannot connect to database. Error: ' . $conn->connect_error . '
                .</div>';
                exit(0);
            }
            $sql = "SELECT * FROM lecturelinks";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row['date'] = date('d-M-Y', strtotime($row['date']));
                    $teacherId = $row['teacherid'];
                    $sql1 = "SELECT name FROM userdetails WHERE id='$teacherId'";
                    $result1 = $conn->query($sql1);
                    $row1 = $result1->fetch_assoc();
                    echo '<tr>                    
                    <td>' . $row['date'] . '</td>  
                    <td>' . $row1['name'] . '</td>                                      
                    <td>' . $row['title'] . '</td>
                    <td><a href="videoPlayer.php?slno=' . $row['slno'] . '" target="_blank">Play</a></td>                                
                </tr>';
                }
            } else {
                echo '<div class="alert alert-warning alert-box" role="alert">
                No data found!</div>';
                exit(0);
            }
            $conn->close();     //Closing database connection
            ?>
        </tbody>
    </table>
    <!-- table end -->
</body>

</html>